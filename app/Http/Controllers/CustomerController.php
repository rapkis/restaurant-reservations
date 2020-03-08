<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers.
     *
     * @return View
     */
    public function index(): View
    {
        $customers = Customer::with(['reservations'])->get();

        return view('customer.index', compact('customers'));
    }

    /**
     * Remove the specified customer from storage.
     *
     * @param  Customer $customer
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('status', 'Customer Deleted');
    }
}
