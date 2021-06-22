<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // show the cart page
    public function index()
    {
        // session()->forget('cart');

        // if no cart check db
        // check if session cart sent the cart
        $cart = session()->get('cart');
        if (isset($cart)) {
            return view('site.cart', compact('cart'));
        }

        // if there is no cart
        return view('site.cart');
    } // end add to cart


    // add to cart function
    public function addToCart(Product $product)
    {
        $cart = session()->get('cart');

        // check if cart and this product exist then increment quantity
        if (isset($cart[$product->id])) {

            $qty = $cart[$product->id]['quantity']++;

            session()->put('cart', $cart);

            self::setCartTotalPrice();

            $this->update($product->id);

            session()->flash('success', 'added successfully');

            return response()->json([
                'product_id' => $product->id,
                'quantity' => $qty,
            ]);
        }

        // if cart is empty or don't have the product then creat cart or just add the product
        $cart[$product->id] = [
            "id" => $product->id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->photo
        ];

        session()->put('cart', $cart);

        self::setCartTotalPrice();

        self::store($product->id);

        session()->flash('success', 'added successfully');

        return view('site.includes._cart_row', ['cart_product' => $cart[$product->id]]);
    } // end add to cart


    // detach old cart and attach the new one
    public static function store($product_id)
    {
        // check auth user
        if (!auth('web')->check()) {
            return;
        }

        // check if cart exist
        $cart = session()->get('cart');
        if (!isset($cart)) {
            return;
        }

        // add cart data to db
        $user = User::findOrFail(Auth::id());

        $user->products()->attach([
            $product_id  => [
                'quantity' => $cart[$product_id]['quantity'],
            ]
        ]);
    } // end of store

    public function update($product_id)
    {
        if (!auth('web')->check()) {
            return;
        }

        $user = User::findOrFail(Auth::id());

        $cart = session()->get('cart');

        if (isset($cart)) {
            $user->products()->updateExistingPivot($product_id, [
                'quantity' => session()->get('cart')[$product_id]['quantity']
            ]);
        }
    }


    public static function handleCartDataWhenLogin()
    {
        $user = User::findOrFail(Auth::id());

        // if there is an old cart user merge data
        $cart = session('cart');
        if (!isset($cart)) {

            if ($user->products()->count()) {

                $oldCart = [];
                foreach ($user->products as $product) {
                    $oldCart += [
                        $product->id = [
                            "id" => $product->id,
                            "name" => $product->name,
                            "quantity" => $product->pivot->quantity,
                            "price" => $product->price,
                            "photo" => $product->photo
                        ]
                    ];
                }
            }
            session()->put('cart', $oldCart);
            self::setCartTotalPrice();

            return;
        }


        $data = [];

        foreach ($cart as $produdct_id => $product) {

            $data += [
                $produdct_id => [
                    'quantity' => $product['quantity'],
                ]
            ];
        }

        $user->products()->sync($data);
    }


    public function changeQuantity(Product $product, Request $request)
    {
        $cart = session()->get('cart');
        $cart[$product->id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);

        $this->update($product->id);
        return response()->json([
            'product_id' => $product->id,
            'quantity' => $cart[$product->id]['quantity'],
        ]);
    } // end change quantitu function

    // calculate and set tha total pricse in the session
    public static function setCartTotalPrice()
    {
        $cart = session()->get('cart');
        $total_price = 0;

        foreach ($cart as $product) {
            $total_price += $product['quantity'] * $product['price'];
        }

        session()->put('total_price', $total_price);
    }

    public function removeItem($product_id)
    {
        // remove from cart
        $cart = session()->get('cart');
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);
        }

        // remove from db

        // check auth user
        if (auth('web')->check()) {

            $user = User::findOrFail(Auth::id());

            if ($user->products()->where('product_id', $product_id)->exists()) {

                $user->products()->detach($product_id);
            }
        }

        return redirect()->back()->with('success', 'item removed successfully');
    }


    public function clear()
    {
        session()->forget('cart');

        if (auth()->user()) {
            $this->delete();
        }
        session()->flash('success', 'cart cleared');

        return redirect()->back();
    } // end of clear cart function

    public static function delete()
    {
        $user = User::findOrFail(Auth::id());

        if ($user->products->count()) {

            $user->products()->detach();
        }
    }
}// end of cart controller
