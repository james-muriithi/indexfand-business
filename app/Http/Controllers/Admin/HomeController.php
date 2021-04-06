<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $userBusinesses = Auth::user()->userBusinesses()->pluck('id');
        $settings1 = [
            'chart_title'           => 'Businesses',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Business',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'business',
        ];

        $settings1['total_number'] = 0;

        if (class_exists($settings1['model'])) {
            $q = null;
            if (!Auth::user()->isAdmin){
                $q = $settings1['model']::whereIn('id', $userBusinesses)
                ->when(isset($settings1['filter_field']), function ($query) use ($settings1) {
                    if (isset($settings1['filter_days'])) {
                        return $query->where(
                            $settings1['filter_field'],
                            '>=',
                            now()->subDays($settings1['filter_days'])->format('Y-m-d')
                        );
                    } else if (isset($settings1['filter_period'])) {
                        switch ($settings1['filter_period']) {
                            case 'week':
                                $start  = date('Y-m-d', strtotime('last Monday'));
                                break;
                            case 'month':
                                $start = date('Y-m') . '-01';
                                break;
                            case 'year':
                                $start  = date('Y') . '-01-01';
                                break;
                        }

                        if (isset($start)) {
                            return $query->where($settings1['filter_field'], '>=', $start);
                        }
                    }
                });
            }else{
                $q = $settings1['model']::when(isset($settings1['filter_field']), function ($query) use ($settings1) {
                    if (isset($settings1['filter_days'])) {
                        return $query->where(
                            $settings1['filter_field'],
                            '>=',
                            now()->subDays($settings1['filter_days'])->format('Y-m-d')
                        );
                    } else if (isset($settings1['filter_period'])) {
                        switch ($settings1['filter_period']) {
                            case 'week':
                                $start  = date('Y-m-d', strtotime('last Monday'));
                                break;
                            case 'month':
                                $start = date('Y-m') . '-01';
                                break;
                            case 'year':
                                $start  = date('Y') . '-01-01';
                                break;
                        }

                        if (isset($start)) {
                            return $query->where($settings1['filter_field'], '>=', $start);
                        }
                    }
                });
            }
            $settings1['total_number'] = $q->{$settings1['aggregate_function'] ?? 'count'}($settings1['aggregate_field'] ?? '*');
        }

        //settings 2
        $settings2 = [
            'chart_title'           => 'Total Balance',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Business',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'balance',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'business',
        ];

        $settings2['total_number'] = 0;

        if (class_exists($settings2['model'])) {
            if (!Auth::user()->isAdmin){
                $q = $settings2['model']::whereIn('id', $userBusinesses)
                    ->when(isset($settings3['filter_field']), function ($query) use ($settings2) {
                    if (isset($settings2['filter_days'])) {
                        return $query->where(
                            $settings2['filter_field'],
                            '>=',
                            now()->subDays($settings2['filter_days'])->format('Y-m-d')
                        );
                    } else if (isset($settings2['filter_period'])) {
                        switch ($settings2['filter_period']) {
                            case 'week':
                                $start  = date('Y-m-d', strtotime('last Monday'));
                                break;
                            case 'month':
                                $start = date('Y-m') . '-01';
                                break;
                            case 'year':
                                $start  = date('Y') . '-01-01';
                                break;
                        }

                        if (isset($start)) {
                            return $query->where($settings2['filter_field'], '>=', $start);
                        }
                    }
                });
            }else{
                $q = $settings2['model']::when(isset($settings2['filter_field']), function ($query) use ($settings2) {
                    if (isset($settings2['filter_days'])) {
                        return $query->where(
                            $settings2['filter_field'],
                            '>=',
                            now()->subDays($settings2['filter_days'])->format('Y-m-d')
                        );
                    } else if (isset($settings2['filter_period'])) {
                        switch ($settings2['filter_period']) {
                            case 'week':
                                $start  = date('Y-m-d', strtotime('last Monday'));
                                break;
                            case 'month':
                                $start = date('Y-m') . '-01';
                                break;
                            case 'year':
                                $start  = date('Y') . '-01-01';
                                break;
                        }

                        if (isset($start)) {
                            return $query->where($settings2['filter_field'], '>=', $start);
                        }
                    }
                });
            }
            $settings2['total_number'] = $q->{$settings2['aggregate_function'] ?? 'count'}($settings2['aggregate_field'] ?? '*');
        }


        //settings 3
        $settings3 = [
            'chart_title'           => 'Today Sales',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Payment',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'amount',
            'filter_field'          => 'created_at',
            'filter_period'         => 'today',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'payment',
        ];

        $settings3['total_number'] = 0;

        if (class_exists($settings3['model'])) {
            $settings3['total_number'] = $settings3['model']::when(isset($settings3['filter_field']), function ($query) use ($settings3) {
                if (isset($settings3['filter_days'])) {
                    return $query->where(
                        $settings3['filter_field'],
                        '>=',
                        now()->subDays($settings3['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings3['filter_period'])) {
                    switch ($settings3['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                        case 'today':
                            return $query->whereDate($settings3['filter_field'], today());
                    }

                    if (isset($start)) {
                        return $query->where($settings3['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings3['aggregate_function'] ?? 'count'}($settings3['aggregate_field'] ?? '*');
        }


        $settings4 = [
            'chart_title'           => 'Recent Payments',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Payment',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-12',
            'entries_number'        => '20',
            'fields'                => [
                'id'             => '',
                'sender_name'    => '',
                'business'       => 'name',
                'sender_contact' => '',
                'code'           => '',
                'amount'         => '',
                'created_at'     => '',
            ],
            'translation_key'       => 'payment',
        ];

        $settings4['data'] = [];

        if (class_exists($settings4['model'])) {
            if (!Auth::user()->isAdmin){
                $settings4['data'] = $settings4['model']::whereHas('business', function ($query) use ($userBusinesses){
                        $query->whereIn('id', $userBusinesses);
                    })
                    ->latest()
                    ->take($settings4['entries_number'])
                    ->get();
            }else{
                $settings4['data'] = $settings4['model']::latest()
                    ->take($settings4['entries_number'])
                    ->get();
            }

        }

        if (!array_key_exists('fields', $settings4)) {
            $settings4['fields'] = [];
        }

        $settings5 = [
            'chart_title'           => 'This Month Payments',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Payment',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'month',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'translation_key'       => 'payment',
        ];

        $chart5 = Auth::user()->isAdmin ? new LaravelChart($settings5) : null;

        $settings6 = [
            'chart_title'           => 'Total Withdraws',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Withdraw',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'amount',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'withdraw',
        ];

        $settings6['total_number'] = 0;

        if (class_exists($settings6['model'])) {
            $settings6['total_number'] = $settings6['model']::when(isset($settings6['filter_field']), function ($query) use ($settings6) {
                if (isset($settings6['filter_days'])) {
                    return $query->where(
                        $settings6['filter_field'],
                        '>=',
                        now()->subDays($settings6['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings6['filter_period'])) {
                    switch ($settings6['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings6['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings6['aggregate_function'] ?? 'count'}($settings6['aggregate_field'] ?? '*');
        }


        return view('home',
            compact('settings1', 'settings2', 'settings3', 'settings4', 'chart5', 'settings6'));
    }
}
