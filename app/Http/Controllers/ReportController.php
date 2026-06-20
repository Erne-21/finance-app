<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Display the 3-section report:
     * 1) Period selection (date range filter)
     * 2) Categorical summary (totals per category)
     * 3) Statistical analysis (min, max, average)
     */
    public function index(Request $request): View
    {
        $request->validate([
            'date_from' => 'nullable|date',
            'date_to'   => 'nullable|date|after_or_equal:date_from',
        ]);

        $transactions = auth()->user()
            ->transactions()
            ->with('category')
            ->betweenDates($request->date_from, $request->date_to)
            ->get();

        // Section 2: totals grouped by category name (keeping type for the badge)
        $byCategory = $transactions
            ->groupBy(fn ($t) => $t->category->name ?? 'Uncategorized')
            ->map(function ($group) {
                return [
                    'type'  => $group->first()->type,
                    'total' => $group->sum('amount'),
                ];
            })
            ->sortByDesc(fn ($row) => $row['total']);

        // Section 3: statistical overview
        $stats = [
            'min' => $transactions->min('amount') ?? 0,
            'max' => $transactions->max('amount') ?? 0,
            'avg' => $transactions->count() ? round($transactions->avg('amount'), 2) : 0,
        ];

        $totalIncome  = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');

        return view('reports.index', [
            'transactions' => $transactions,
            'byCategory'   => $byCategory,
            'stats'        => $stats,
            'totalIncome'  => $totalIncome,
            'totalExpense' => $totalExpense,
            'dateFrom'     => $request->date_from,
            'dateTo'       => $request->date_to,
        ]);
    }
}
