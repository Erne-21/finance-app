<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Display the authenticated user's transactions plus balance overview.
     */
    public function index(): View
    {
        $transactions = auth()->user()
            ->transactions()
            ->with('category')
            ->orderByDesc('date')
            ->get();

        $totalIncome  = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $balance      = $totalIncome - $totalExpense;

        return view('transactions.index', compact(
            'transactions',
            'totalIncome',
            'totalExpense',
            'balance'
        ));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create(): View
    {
        $categories = auth()->user()->categories()->orderBy('name')->get();

        return view('transactions.create', compact('categories'));
    }

    /**
     * Store a newly created transaction.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateTransaction($request);

        auth()->user()->transactions()->create($validated);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction added successfully.');
    }

    /**
     * Show the form for editing a transaction.
     */
    public function edit(Transaction $transaction): View
    {
        $this->authorize('update', $transaction);

        $categories = auth()->user()->categories()->orderBy('name')->get();

        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * Update an existing transaction.
     */
    public function update(Request $request, Transaction $transaction): RedirectResponse
    {
        $this->authorize('update', $transaction);

        $validated = $this->validateTransaction($request);

        $transaction->update($validated);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }

    /**
     * Delete a transaction.
     */
    public function destroy(Transaction $transaction): RedirectResponse
    {
        $this->authorize('delete', $transaction);

        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }

    /**
     * Shared validation rules for store/update.
     * Also ensures the chosen category belongs to the current user.
     */
    private function validateTransaction(Request $request): array
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'type'        => 'required|in:income,expense',
            'amount'      => 'required|numeric|min:0.01|max:99999999.99',
            'date'        => 'required|date',
            'description' => 'nullable|string|max:500',
        ]);

        // Defense in depth: make sure the category actually belongs to this user.
        $ownsCategory = auth()->user()
            ->categories()
            ->where('id', $validated['category_id'])
            ->exists();

        if (! $ownsCategory) {
            abort(403, 'Invalid category selected.');
        }

        return $validated;
    }
}