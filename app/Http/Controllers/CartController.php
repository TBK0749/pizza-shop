<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        if (Auth::check()) {
            if (Cart::where('pizza_id', $request->pizza_id)->where('user_id', Auth::id())->exists()) {
                $item = Cart::where('pizza_id', $request->pizza_id)->where('user_id', Auth::id())->first();
                $newPizzaQty = $item->pizza_qty + $request->pizza_qty;
                $item->update(['pizza_qty' => $newPizzaQty]);
            } else {
                $newItem = Cart::create([
                    'user_id' => Auth::id(),
                    'pizza_id' => $request->pizza_id,
                    'pizza_qty' => $request->pizza_qty,
                ]);
            }

            return redirect(route('home.index'));
        } else {
            return redirect(route('login.show'));
        }
    }

    static function cartItem()
    {
        return Cart::where('user_id', Auth::id())->count();
    }

    public function cartList()
    {
        // Pizzas จะเก็บ cart ของ user ทุกคนในเว็บ (code ตอนนี้)
        // 1. ต้องผูก cart กับ user เราจะได้โชว์ cart ได้ถูกอันตอน user เปิดหน้า cart
        // 2. ต้องเก็บว่า cart นั้น checkout ไปแล้วหรือไม่ (ตอนไหน)
        // 3. เวลาเป็นหน้า cart จะโชว์เฉพาะ cart ล่าสุดที่ยังไม่ checkout ที
        // 4. user ควรลบ pizza ออกจาก cart ได้
        // 5. ตอน checkout แล้ว order ควรถูกสร้าง และ cart ควรถูกบันทึกว่า check out แล้ว และสร้าง cart ใหม่ (ที่ว่าง) ให้ user

        // ตาราง cart จะมี user ผูกกับ ตะกร้า (อาจจะมี column อื่น เช่น checked_out_at เป็น timestamp (default null))
        // ตาราง cart_items ที่จะผูก cart_id กับ pizza_id (many to many)
        // พยายามใช้ relationship
        // $userId = Auth::user()->id;
        // $cartId = Auth::user()->cart->id;
        // $cartItems = CartItem::with(['pizza'])->whereCartId($cartId)->get();
        // $pizzas = Cart::join('pizzas', 'cart.pizza_id', '=', 'pizzas.id')
        //     ->get('pizzas.*');

        // post -> รูป
        // user -> รูป
        // comment -> รูป
        // asd
        // qwdq

        // posts -> id, post_image_id
        // post_images -> id, path

        // users -> id, user_image_id
        // user_images -> id, path

        // comment_images
        // aasdasd_images
        // 12d12d_images
        // sdiqwid_images
        // aasjdjasd_images

        // images -> id, type, type_id, path
        //            1, user, 1, /asqwdqwd.jpg
        //            2, user, 60, /asidjisd1o2922.jpg
        //            3, post, 1, /ssksosko91212.jpg

        // jobs -> id, type, type_id
        //              talent, 1
        //              client, 50

        $cartItems = Auth::user()->carts;
        $pizzas = $cartItems->map(function ($item, $key) {
            return $item->pizzas;
        });

        return view('cart.cart-list', [
            'pizzas' => $pizzas,
            'cartItems' => $cartItems,
        ]);
    }

    public function deleteItem(Request $request)
    {
        $pizza_id = $request->pizza_id;
        if (Cart::where('pizza_id', $pizza_id)->where('user_id', Auth::id())->exists()) {
            $item = Cart::where('pizza_id', $pizza_id)->where('user_id', Auth::id())->first();
            $item->delete();
            return redirect(route('cartList'))->with('success', 'Successfully deleted.');;
        }
    }

    public function incrementQty(Request $request)
    {
        $pizza_id = $request->pizza_id;
        if (Cart::where('pizza_id', $pizza_id)->where('user_id', Auth::id())->exists()) {
            $item = Cart::where('pizza_id', $pizza_id)->where('user_id', Auth::id())->first();
            $newPizzaQty = $item->pizza_qty + 1;
            $item->update(['pizza_qty' => $newPizzaQty]);
            return redirect(route('cartList'));
        }
    }

    public function decrementQty(Request $request)
    {
        $pizza_id = $request->pizza_id;
        if (Cart::where('pizza_id', $pizza_id)->where('user_id', Auth::id())->exists()) {
            $item = Cart::where('pizza_id', $pizza_id)->where('user_id', Auth::id())->first();
            $item->pizza_qty === 1 ?
                $newPizzaQty = 1 :
                $newPizzaQty = $item->pizza_qty - 1;
            $item->update(['pizza_qty' => $newPizzaQty]);
            return redirect(route('cartList'));
        }
    }
}
