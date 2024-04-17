<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Group;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GroupController extends Controller
{
    /**
     * Displays a list of all groups.
     */
    public function index()
    {
        try {
            return Group::all();
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Created a new group.
     * @bodyParam name string required The name of the new group. Example: VIP
     */

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $group = Group::create($validator->validated());

        return response()->json($group, Response::HTTP_CREATED);
    }


    /**
     * Display a specific group.
     * @urlParam group integer required The ID of the group. Example: 1
     */
    public function show($groupId)
    {
        try {
            return Group::findOrFail($groupId);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Group not found'], Response::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update a specific group.
     * @urlParam group integer required The ID of the group. Example: 1
     * @bodyParam name string required The name of the new group. Example: Inactive
     */
    public function update(Request $request, $groupId): JsonResponse
    {
        $group = Group::find($groupId);
        if (!$group) {
            return response()->json(['message' => 'Group not found'], Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $group->update($validator->validated());

        return response()->json($group, Response::HTTP_OK);
    }

    /**
     * Delete a specific group.
     * @urlParam group integer required The ID of the group. Example: 1
     */
    public function destroy($groupId): JsonResponse
    {
        try {
            $group = Group::findOrFail($groupId);
            $group->delete();

            return response()->json(['message' => 'Group deleted successfully'], Response::HTTP_OK);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Group not found'], Response::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the customers in a specific group.
     * @urlParam group integer required The ID of the group. Example: 1
     */
    public function listCustomers($groupId): JsonResponse
    {
        try {
            $group = Group::findOrFail($groupId);
            $customers = $group->customers;

            if ($customers->isEmpty()) {
                return response()->json(['error' => 'No customers on this group'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($customers, Response::HTTP_OK);

        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Group not found'], Response::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Add a customer to a specific group.
     * @urlParam group integer required The ID of the group. Example: 1
     * @urlParam customer integer required The ID of the customer. Example: 1
     */
    public function addCustomers($groupId, $customerId): JsonResponse
    {
        try {
            $customer = Customer::findOrFail($customerId);

            if ($customer->group_id == $groupId) {
                return response()->json(['message' => 'Customer already in the group'], Response::HTTP_CONFLICT);
            }

            $customer->group_id = $groupId;
            $customer->save();

            return response()->json(['message' => 'Customer added successfully'], Response::HTTP_OK);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => "Not found"], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Failed to add the customer: ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove a customer from a specific group.
     * @urlParam group integer required The ID of the group. Example: 1
     * @urlParam customer integer required The ID of the customer. Example: 1
     */
    public function removeCustomers($groupId, $customerId): JsonResponse
    {
        try {
            $group = Group::find($groupId);
            if (!$group) {
                return response()->json(['message' => 'Group not found'], Response::HTTP_NOT_FOUND);
            }

            $customer = Customer::where('id', $customerId)->where('group_id', $groupId)->first();
            if (!$customer) {
                return response()->json(['message' => 'Customer not found in the group'], Response::HTTP_NOT_FOUND);
            }

            $customer->group_id = null;
            $customer->save();

            return response()->json([
                'message' => 'Customer removed successfully from the group'
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => "Not found"], Response::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
