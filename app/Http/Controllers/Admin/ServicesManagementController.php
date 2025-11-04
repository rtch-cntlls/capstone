<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Services\Admin\ServiceManagementService;
use PDF;
use Illuminate\Support\Facades\Response;

class ServicesManagementController extends Controller
{
    protected ServiceManagementService $serviceManager;

    public function __construct(ServiceManagementService $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    public function index()
    {
        try {
            $services     = $this->serviceManager->getPaginatedServices();
            $cards        = $this->serviceManager->getCardsData();
            $servicesData = $this->serviceManager->getServicesDataFromJson();

            return view('admin.pages.services.index', compact('services', 'servicesData', 'cards'));
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function show($serviceId)
    {
        try {
            $service = Service::findOrFail($serviceId);

            return view('admin.pages.services.show', compact('service'));
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'duration'    => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        try {
            $this->serviceManager->createService($request->all());

            return redirect()->back()->with('success', 'Service added successfully!');
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function update(Request $request, $serviceId)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'duration'    => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        try {
            $service = Service::findOrFail($serviceId);
            $this->serviceManager->updateService($service, $request->all());

            return redirect()->back()->with('success', 'Service updated successfully!');
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function toggleStatus($serviceId)
    {
        try {
            $service = Service::findOrFail($serviceId);
            $this->serviceManager->toggleServiceStatus($service);

            return redirect()->back()->with('success-alert', 'Service status updated!');
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function exportPdf()
    {
        $services = Service::all();
        $pdf = PDF::loadView('admin.pages.services.export-pdf', compact('services'));
        return $pdf->download('services.pdf');
    }

    public function exportCsv()
    {
        $services = Service::all();
        $filename = 'services.csv';
        $handle = fopen($filename, 'w+');

        fputcsv($handle, [ 'Name', 'Category', 'Price', 'Duration', 'Status']);

        foreach ($services as $service) {
            fputcsv($handle, [
                $service->name,
                $service->category,
                $service->price,
                $service->duration,
                $service->status,
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
