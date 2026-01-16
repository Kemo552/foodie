<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private $categories;
    private $products;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->getUser();
        $this->categories = Category::factory(3)->create();
        $this->products = Product::factory(3)->create();
    }

    public function test_perform_payment_using_credit_card_way_succeeded(): void
    {
        // Add 3 products to Cart
        Cart::factory(3)->create(['user_id' => $this->user->id]);

        // Add payment details (using "credit card" details)
        $payment_details = [
            'name' => fake()->name(5),
            'card_no' => (string) (rand(1000000000000000, 9999999999999999)),
            'year' => 2050,
            'month' => 12,
            'cvv' => rand(100, 999),
            'delivery_address' => fake()->address(),
        ];

        $response = $this->actingAs($this->user)->post('/user/payment', $payment_details);

        $last_inserted_payment = Payment::latest()->first();
        $response->assertStatus(302);
        $response->assertRedirect('/user/invoice/' . $last_inserted_payment->id);

        $this->assertDatabaseCount('carts', 0);
        $this->assertDatabaseCount('payments', 1);
        $this->assertDatabaseCount('orders', 3);
    }

    public function test_perform_payment_using_cash_on_delivery_way_succeeded(): void
    {
        // Add 3 products to Cart
        Cart::factory(3)->create(['user_id' => $this->user->id]);

        // Add payment details (using "address" details)
        $payment_details = [
            'cod_address' => fake()->address(),
        ];

        $response = $this->actingAs($this->user)->post('/user/payment', $payment_details);

        $last_inserted_payment = Payment::latest()->first();
        $response->assertStatus(302);
        $response->assertRedirect('/user/invoice/' . $last_inserted_payment->id);

        $this->assertDatabaseCount('carts', 0);
        $this->assertDatabaseCount('payments', 1);
        $this->assertDatabaseCount('orders', 3);
    }

    public function test_perform_payment_validation_error_redirects_back_to_cart(): void
    {
        // Add 3 products to Cart
        Cart::factory(3)->create(['user_id' => $this->user->id]);

        // Add payment details (using "address" details)
        $payment_details = [
            'cod_address' => '',
        ];

        $response = $this->actingAs($this->user)->post('/user/payment', $payment_details);

        $response->assertStatus(302);
        $response->assertRedirect('/user/cart');

        $this->assertDatabaseCount('payments', 0);
        $this->assertDatabaseCount('orders', 0);
        $this->assertDatabaseCount('carts', 3);
    }

    private function getUser(): User
    {
        return User::factory()->create();
    }
}