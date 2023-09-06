<?php

namespace App\DataTables;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class SubscriptionsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'subscriptions.datatables.action')
            ->editColumn('plan', function(Subscription $subscription) {
                $plan = Plan::find($subscription->plan_id);
                return $plan->name;
            })
            ->editColumn('renewal_date', function(Subscription $subscription) {
                return date("F jS, Y", strtotime($subscription->renewal_date));
            })
            ->editColumn('created_at', function(Subscription $subscription) {
                return date("F jS, Y", strtotime($subscription->created_at));
            })
            ->editColumn('updated_at', function(Subscription $subscription) {
                return date("F jS, Y", strtotime($subscription->updated_at));
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Subscription $model, Request $request): QueryBuilder
    {
        $userId = $request->route('id');
        return $model->newQuery()->where('user_id', $userId);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('subscriptions')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('plan'),
            Column::make('renewal_date'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Subscriptions_' . date('YmdHis');
    }
}
