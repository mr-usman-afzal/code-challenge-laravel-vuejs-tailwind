<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\utilities\ResponseHelper;

class ContactController extends Controller
{

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'isAdmin'], ['only' => 'destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $contacts = Contact::all();
            return ResponseHelper::success('Contacts retrieved successfully', $contacts);
        } catch (\Exception $e) {
            return ResponseHelper::failure($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContactRequest $request
     * @return JsonResponse
     */
    public function store(ContactRequest $request): JsonResponse
    {
        try {
            $contact = Contact::create($request->validated());
            return ResponseHelper::success('Contact created successfully', $contact, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return ResponseHelper::failure($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ContactRequest $request
     * @param Contact $contact
     * @return JsonResponse
     */
    public function update(ContactRequest $request, Contact $contact): JsonResponse
    {
        $contact->update($request->validated());
        return ResponseHelper::success('Contact updated successfully', $contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contact $contact
     * @return JsonResponse
     */
    public function destroy(Contact $contact): JsonResponse
    {
        try {
            $contact->delete();
            return ResponseHelper::success('Contact deleted successfully', null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return ResponseHelper::failure($e->getMessage());
        }
    }
}
