<<<<<<< HEAD
<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\BusinessTax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables; 
class BusinessTaxController extends Controller
{
    /**
     * Display a listing of taxes with search and pagination.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('default.panel.business.taxes.index');
    }

    public function gettaxesdata(Request $request)
    {
        try {
            $query = BusinessTax::query();

            // Apply filters
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->filled('rate')) {
                $query->where('rate', 'like', '%' . $request->rate . '%');
            }

            return DataTables::of($query)
                ->addColumn('checkbox', function($tax) {
                    return '';
                })
                ->addColumn('actions', function($tax) {
                    return '';
                })
                ->editColumn('created_at', function($tax) {
                    return $tax->created_at->format('Y-m-d H:i:s');
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);

        } catch (\Exception $e) {
            Log::error('Tax datatable error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to load tax data'
            ], 500);
        }
    }

    public function bulkAction(Request $request)
    {
        try {
            $ids = $request->ids;
            
            if (empty($ids)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No taxes selected'
                ]);
            }

            BusinessTax::whereIn('id', $ids)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Selected taxes deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Bulk tax delete error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete taxes'
            ], 500);
        }
    }

    /**
     * Show the form for creating a new tax.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('default.panel.business.taxes.create');
    }
    public function destroyByGet($id)
    {
        $tax = BusinessTax::findOrFail($id);
    
        $tax->delete();
    return redirect()
                    ->route('dashboard.business.taxes.index')
                    ->with('message', 'Tax entry deleted successfully.')
                    ->with('type', 'success');
    }
    /**
     * Store a newly created tax in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('business_taxes')->whereNull('deleted_at')
                ],
                'rate' => 'required|numeric|min:0|max:100|decimal:0,2',
            ]);

            BusinessTax::create($validated);

            return redirect()
                ->route('dashboard.business.taxes.index')
                ->with('success', 'Tax created successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Tax store error: '.$e->getMessage());
            return redirect()->back()->with('error', 'Failed to create tax. Please try again.' .$e->getMessage());
        }
    }

    /**
     * Display the specified tax.
     *
     * @param BusinessTax $tax
     * @return \Illuminate\View\View
     */
    public function show(BusinessTax $tax)
    {
        return view('default.panel.business.taxes.show', compact('tax'));
    }

    /**
     * Show the form for editing the specified tax.
     *
     * @param BusinessTax $tax
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, BusinessTax $tax)
    {
        return view('default.panel.business.taxes.create', compact('tax'));
    }

    /**
     * Update the specified tax in storage.
     *
     * @param Request $request
     * @param BusinessTax $tax
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BusinessTax $tax)
    {
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('business_taxes')->ignore($tax->id)->whereNull('deleted_at')
                ],
                'rate' => 'required|numeric|min:0|max:100|decimal:0,2',
            ]);

            $tax->update($validated);

            return redirect()
                ->route('dashboard.business.taxes.index')
                ->with('success', 'Tax updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Tax update error: '.$e->getMessage());
            return redirect()->back()->with('error', 'Failed to update tax. Please try again.');
        }
    }

    /**
     * Remove the specified tax from storage.
     *
     * @param BusinessTax $tax
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BusinessTax $tax)
    {
        try {
            $tax->delete();

            return redirect()
                ->route('dashboard.business.taxes.index')
                ->with('success', 'Tax deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Tax delete error: '.$e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete tax. Please try again.');
        }
    }

    /**
     * Handle bulk actions for taxes.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
//     public function bulkAction(Request $request)
//     {
//         try {
//             $request->validate([
//                 'ids' => 'required|array',
//                 'ids.*' => 'exists:business_taxes,id',
//                 'action' => 'required|in:delete'
//             ]);

//             $count = BusinessTax::whereIn('id', $request->ids)->delete();

//             return response()->json([
//                 'success' => true,
//                 'message' => $count.' '.str('tax')->plural($count).' deleted successfully.'
//             ]);

//         } catch (\Exception $e) {
//             Log::error('Tax bulk action error: '.$e->getMessage());
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Failed to perform bulk action.'
//             ], 500);
//         }
//     }
      public function bulkdelete(Request $request)
    {
        $ids = $request->input('ids');
        BusinessTax::whereIn('id', $request->ids)->delete();
    
    return response()->json(['success' => true]);
}
=======
<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\BusinessTax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables; 
class BusinessTaxController extends Controller
{
    /**
     * Display a listing of taxes with search and pagination.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('default.panel.business.taxes.index');
    }

    public function gettaxesdata(Request $request)
    {
        try {
            $query = BusinessTax::query();

            // Apply filters
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->filled('rate')) {
                $query->where('rate', 'like', '%' . $request->rate . '%');
            }

            return DataTables::of($query)
                ->addColumn('checkbox', function($tax) {
                    return '';
                })
                ->addColumn('actions', function($tax) {
                    return '';
                })
                ->editColumn('created_at', function($tax) {
                    return $tax->created_at->format('Y-m-d H:i:s');
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);

        } catch (\Exception $e) {
            Log::error('Tax datatable error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to load tax data'
            ], 500);
        }
    }

    public function bulkAction(Request $request)
    {
        try {
            $ids = $request->ids;
            
            if (empty($ids)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No taxes selected'
                ]);
            }

            BusinessTax::whereIn('id', $ids)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Selected taxes deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Bulk tax delete error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete taxes'
            ], 500);
        }
    }

    /**
     * Show the form for creating a new tax.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('default.panel.business.taxes.create');
    }
    public function destroyByGet($id)
    {
        $tax = BusinessTax::findOrFail($id);
    
        $tax->delete();
    return redirect()
                    ->route('dashboard.business.taxes.index')
                    ->with('message', 'Tax entry deleted successfully.')
                    ->with('type', 'success');
    }
    /**
     * Store a newly created tax in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('business_taxes')->whereNull('deleted_at')
                ],
                'rate' => 'required|numeric|min:0|max:100|decimal:0,2',
            ]);

            BusinessTax::create($validated);

            return redirect()
                ->route('dashboard.business.taxes.index')
                ->with('success', 'Tax created successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Tax store error: '.$e->getMessage());
            return redirect()->back()->with('error', 'Failed to create tax. Please try again.' .$e->getMessage());
        }
    }

    /**
     * Display the specified tax.
     *
     * @param BusinessTax $tax
     * @return \Illuminate\View\View
     */
    public function show(BusinessTax $tax)
    {
        return view('default.panel.business.taxes.show', compact('tax'));
    }

    /**
     * Show the form for editing the specified tax.
     *
     * @param BusinessTax $tax
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, BusinessTax $tax)
    {
        return view('default.panel.business.taxes.create', compact('tax'));
    }

    /**
     * Update the specified tax in storage.
     *
     * @param Request $request
     * @param BusinessTax $tax
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BusinessTax $tax)
    {
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('business_taxes')->ignore($tax->id)->whereNull('deleted_at')
                ],
                'rate' => 'required|numeric|min:0|max:100|decimal:0,2',
            ]);

            $tax->update($validated);

            return redirect()
                ->route('dashboard.business.taxes.index')
                ->with('success', 'Tax updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Tax update error: '.$e->getMessage());
            return redirect()->back()->with('error', 'Failed to update tax. Please try again.');
        }
    }

    /**
     * Remove the specified tax from storage.
     *
     * @param BusinessTax $tax
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BusinessTax $tax)
    {
        try {
            $tax->delete();

            return redirect()
                ->route('dashboard.business.taxes.index')
                ->with('success', 'Tax deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Tax delete error: '.$e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete tax. Please try again.');
        }
    }

    /**
     * Handle bulk actions for taxes.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
//     public function bulkAction(Request $request)
//     {
//         try {
//             $request->validate([
//                 'ids' => 'required|array',
//                 'ids.*' => 'exists:business_taxes,id',
//                 'action' => 'required|in:delete'
//             ]);

//             $count = BusinessTax::whereIn('id', $request->ids)->delete();

//             return response()->json([
//                 'success' => true,
//                 'message' => $count.' '.str('tax')->plural($count).' deleted successfully.'
//             ]);

//         } catch (\Exception $e) {
//             Log::error('Tax bulk action error: '.$e->getMessage());
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Failed to perform bulk action.'
//             ], 500);
//         }
//     }
      public function bulkdelete(Request $request)
    {
        $ids = $request->input('ids');
        BusinessTax::whereIn('id', $request->ids)->delete();
    
    return response()->json(['success' => true]);
}
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
}