<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Products',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Product',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '30',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings1['total_number'] = 0;

        if (class_exists($settings1['model'])) {
            $userShops = Auth::user()->userShops()->pluck('id');
            if (Auth::user()->getIsAdminAttribute()){
                $settings1['total_number'] = $settings1['model']::whereIn('shop_id', $userShops)->when(isset($settings1['filter_field']), function ($query) use ($settings1) {
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
                })
                    ->{$settings1['aggregate_function'] ?? 'count'}($settings1['aggregate_field'] ?? '*');
            }else{
                $settings1['total_number'] = $settings1['model']::when(isset($settings1['filter_field']), function ($query) use ($settings1) {
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
                })
                    ->{$settings1['aggregate_function'] ?? 'count'}($settings1['aggregate_field'] ?? '*');
            }
        }

        $settings2 = [
            'chart_title'           => 'Shops',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Shop',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings2['total_number'] = 0;

        if (class_exists($settings2['model'])) {
            $settings2['total_number'] = $settings2['model']::when(isset($settings2['filter_field']), function ($query) use ($settings2) {
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
            })
                ->{$settings2['aggregate_function'] ?? 'count'}($settings2['aggregate_field'] ?? '*');
        }

        $settings3 = [
            'chart_title'           => 'Orders',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Order',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
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
                    }

                    if (isset($start)) {
                        return $query->where($settings3['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings3['aggregate_function'] ?? 'count'}($settings3['aggregate_field'] ?? '*');
        }

        return view('home', compact('settings1', 'settings2', 'settings3'));
    }
}
