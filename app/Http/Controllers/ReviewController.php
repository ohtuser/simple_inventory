<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use App\Models\Products;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review_post(Request $request)
    {
        ProductReview::create([
            'product_id' => $request->product_id,
            'party_id' => user()->id,
            'rating' => $request->rating ?? 0,
            'comments' => $request->comments
        ]);

        return response()->json(requestSuccess('Review/Rating Posted', '', 'reload', 500));
    }

    public function review_product_wise(Request $request)
    {
        $info = ProductReview::with('get_party')->where('comments', '!=', null)->where('product_id', $request->product_id)->get();
        $html = '';
        if (count($info) > 0) {
            foreach ($info as $i) {
                $profile_image = asset("images/" . $i->get_party->image);
                $html .= '<div class="d-flex align-items-center">
                <div style="width: 50px; height: 50px; overflow: hidden; border-radius: 10%;">';
                if ($i->get_party->image != null) {
                    $html .= '<img src="' .  $profile_image . '" style="width: 100%; " alt="">';
                } else {
                    $html .= '<img style="width: 100%;" src="' . asset("profile.jpg") . '"alt="">';
                }

                $html .= '</div>
                    <p style="margin-bottom: 0; margin-left: 6px">' . $i->get_party->name . '</p>
                </div>
                <p>' . $i->comments . '</p>';
            }
        } else {
            $html = 'No Review Found';
        }

        return response()->json(['html' => $html]);
    }
}
