<?php

namespace App\Http\Controllers;

use App\Services\OrganizationService;
use Illuminate\Http\JsonResponse;

class OrganizationController extends Controller
{
    public function allOrganizations($session_id): JsonResponse
    {
        return OrganizationService::allOrganizations($session_id);
    }
    public function organization($id): JsonResponse
    {
        return OrganizationService::organization($id);
    }
}
