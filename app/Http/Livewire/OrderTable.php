<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class OrderTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Order>
     */
    public function datasource(): Builder
    {
        return Order::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('fullName')

           /** Example of custom column using a closure **/
            ->addColumn('fullName_lower', fn (Order $model) => strtolower(e($model->fullName)))

            ->addColumn('phone')
            ->addColumn('alt-phone')
            ->addColumn('address')
            ->addColumn('email')
            ->addColumn('location')
            ->addColumn('user_id')
            ->addColumn('discount')
            ->addColumn('advance')
            ->addColumn('total_price')
            ->addColumn('gateway')
            ->addColumn('payment_status')
            ->addColumn('delivery_status')
            ->addColumn('rider_id')
            ->addColumn('order_status')
            ->addColumn('note')
            ->addColumn('created_at_formatted', fn (Order $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
      * PowerGrid Columns.
      *
      * @return array<int, Column>
      */
    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('FullName', 'fullName')
                ->sortable()
                ->searchable(),

            Column::make('Phone', 'phone')
                ->sortable()
                ->searchable(),

            Column::make('Alt-phone', 'alt-phone')
                ->sortable()
                ->searchable(),

            Column::make('Address', 'address')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Location', 'location')
                ->sortable()
                ->searchable(),

            Column::make('User id', 'user_id'),
            Column::make('Discount', 'discount'),
            Column::make('Advance', 'advance'),
            Column::make('Total price', 'total_price'),
            Column::make('Gateway', 'gateway')
                ->sortable()
                ->searchable(),

            Column::make('Payment status', 'payment_status')
                ->sortable()
                ->searchable(),

            Column::make('Delivery status', 'delivery_status')
                ->sortable()
                ->searchable(),

            Column::make('Rider id', 'rider_id'),
            Column::make('Order status', 'order_status')
                ->sortable()
                ->searchable(),

            Column::make('Note', 'note')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::inputText('fullName')->operators(['contains']),
            Filter::inputText('phone')->operators(['contains']),
            Filter::inputText('alt-phone')->operators(['contains']),
            Filter::inputText('address')->operators(['contains']),
            Filter::inputText('email')->operators(['contains']),
            Filter::inputText('location')->operators(['contains']),
            Filter::inputText('gateway')->operators(['contains']),
            Filter::inputText('payment_status')->operators(['contains']),
            Filter::inputText('delivery_status')->operators(['contains']),
            Filter::inputText('order_status')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Order Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('order.edit', function(\App\Models\Order $model) {
                    return $model->id;
               }),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('order.destroy', function(\App\Models\Order $model) {
                    return $model->id;
               })
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Order Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($order) => $order->id === 1)
                ->hide(),
        ];
    }
    */
}
