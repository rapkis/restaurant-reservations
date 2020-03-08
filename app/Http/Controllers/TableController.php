<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTableRequest;
use App\Table;
use Illuminate\Http\RedirectResponse;

class TableController extends Controller
{
    /**
     * Update the specified table in storage.
     *
     * @param  UpdateTableRequest  $request
     * @param  Table $table
     * @return RedirectResponse
     */
    public function update(UpdateTableRequest $request, Table $table): RedirectResponse
    {
        $table->update($request->validated());

        return redirect()->back()->with('status', 'Table Updated');
    }

    /**
     * Remove the specified table from storage.
     *
     * @param  Table $table
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Table $table): RedirectResponse
    {
        $table->delete();

        return redirect()->back()->with('status', 'Table Deleted');
    }
}
