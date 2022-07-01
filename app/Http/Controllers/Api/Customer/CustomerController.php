<?php

namespace App\Http\Controllers\Api\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\customer\CustomerResource;
use App\Http\Resources\customer\CustomersDisplay;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'sellers' => CustomersDisplay::collection(Customer::all()),
            'status' => 200
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'message' => "customer not found",
                'status' => 404
            ], 404);
        }

        if (Auth::guard('seller-api')->check() || Auth::guard('customer-api')->check()) {

            return response()->json([
                'customer' => new CustomerResource($customer),
                'status' => 200
            ], 200);
        } else {

            return response()->json([
                "message" => "Unauthenticated.",
                "status" => 401
            ], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'message' => "customer not found",
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'min:3',
            'bio' => 'nullable|min:5',
            'customer_img' => 'image|max:5050|nullable|mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'status' => 400
            ], 400);
        }

        if (Auth::guard('customer-api')->user()->id != $id) {
            return response()->json([
                "message" => "You are not authorized to update this profile",
                "status" => 403
            ], 403);
        }

        if (isset($request->customer_img)) {
            $image = $request->file('customer_img');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            if (!File::exists('images/customers')) {
                File::makeDirectory(public_path() . '/' . 'images/customers', 0777, true);
            }
            $image_resize = Image::make($image);
            $image_resize->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image_resize->save('images/customers/' . $name_gen);

            if (isset($customer->customer_img)) {
                $imagePath = public_path('images/customers/' . $customer->customer_img);
                File::delete($imagePath);
            }

            $customer->update([
                'customer_img' => $name_gen,
            ]);
        }

        $customer->update([
            'name' => $request->name,
            'bio' => $request->bio,
        ]);

        return response()->json([
            'message' => "customer is updated successfully",
            'customer' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'bio' => $customer->bio ?? null,
                'image_url' => $customer->customer_img ? URL::to('images/customers/' . $customer->customer_img) : null
            ],
            'status' => 200
        ], 200);
    }

    public function deleteCustomerImage($customer_id)
    {

        $customer = Customer::find($customer_id);

        if (!$customer) {
            return response()->json([
                'message' => "customer not found",
                'status' => 404
            ], 404);
        }

        if (Auth::guard('customer-api')->user()->id == $customer_id) {
            if (isset($customer->customer_img)) {
                $imagePath = public_path('images/customers/' . $customer->customer_img);
                File::delete($imagePath);
                $customer->update([
                    'customer_img' => null,

                ]);
                return response()->json([
                    'message' => "image is deleted successfully",
                    'status' => 200
                ], 200);
            } else {
                return response()->json([
                    'message' => "there is no image for this customer",
                    'status' => 400
                ], 400);
            }
        } else {
            return response()->json([
                "message" => "You are not authorized to delete this image",
                "status" => 403
            ], 403);
        }
    }


    public function addAddress(Request $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'message' => "customer not found",
                'status' => 404
            ], 404);
        }
        if (Auth::guard('customer-api')->user()->id == $id) {

            $validator = Validator::make($request->all(), [
                'address' => 'required',
                'lat' => 'required|numeric',
                'lng' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->all(),
                    'status' => 400
                ], 400);
            }

            $customer->update([
                'address' => $request->address,
                'lat' => $request->lat,
                'lng' => $request->lng,

            ]);

            return response()->json([
                'message' => "The address is added successfully",
                'status' => 200
            ], 200);
        } else {
            return response()->json([
                "message" => "You are not authorized to add address",
                "status" => 403
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
