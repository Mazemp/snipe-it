@extends('layouts/default')

@section('title')
    {{ trans('admin/access-review/general.campaigns') }}
    @parent
@stop

@section('header_right')
    <a href="{{ route('access-review.campaigns.create') }}" class="btn btn-primary pull-right">
        <x-icon type="plus" class="fa-fw" />
        {{ trans('admin/access-review/general.new_campaign') }}
    </a>
@stop

@section('content')
    <x-container>
        <x-box name="accessReviewCampaigns">
            <x-slot:bulkactions>
                <x-table.bulk-actions
                    action_route="{{ route('access-review.campaigns.bulk-destroy') }}"
                    model_name="access_review_campaign">
                    <option value="delete">{{ trans('general.delete') }}</option>
                </x-table.bulk-actions>
            </x-slot:bulkactions>
            <x-table
                    show_column_search="false"
                    fixed_right_number="1"
                    fixed_number="1"
                    api_url="{{ route('api.access-review.campaigns.index') }}"
                    :presenter="\App\Presenters\AccessReviewCampaignPresenter::dataTableLayout()"
                    export_filename="export-access-review-campaigns-{{ date('Y-m-d') }}"
            />
        </x-box>
    </x-container>
@stop


@section('moar_scripts')
    @include ('partials.bootstrap-table')
@stop
