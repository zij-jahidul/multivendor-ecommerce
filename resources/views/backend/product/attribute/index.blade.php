@extends('backend.layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="align-items-center">
            <h1 class="h3">{{ translate('All Attributes') }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="@if (auth()->user()->can('add_product_attribute')) col-lg-9 @else col-lg-12 @endif">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h8">{{ translate('Attributes') }}</h5>
                </div>
                <div class="card-body">
                    <table class="table aiz-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Name') }}</th>
                                <th width="30%">{{ translate('Category') }}</th>
                                <th>{{ translate('Values') }}</th>
                                <th>{{ translate('Sellers') }}</th>
                                <th>{{ translate('Verify') }}</th>
                                <th class="text-right">{{ translate('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attributes as $key => $attribute)
                                @php
                                    $categoryNames = Illuminate\Support\Facades\DB::table('attribute_category')
                                        ->leftjoin('categories', 'attribute_category.category_id', '=', 'categories.id')
                                        ->select('attribute_category.attribute_id', 'attribute_category.category_id', 'categories.name as categoryName')
                                        ->where('attribute_category.attribute_id', $attribute->id)
                                        ->get();
                                    $i = 1;
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ translate($attribute->name) }}</td>
                                    <td>
                                        @foreach ($categoryNames as $category)
                                            <span>{{ $i++ }} .</span>{{ translate($category->categoryName) }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($attribute->attribute_values as $key => $value)
                                            <span
                                                class="badge badge-inline badge-md bg-soft-dark">{{ $value->value }}</span>
                                        @endforeach
                                    </td>

                                    <td>
                                        @if ($attribute->user)
                                            {{ optional($attribute->user)->name }}
                                        @else
                                            Admin
                                        @endif
                                    </td>

                                    <td>
                                        @if ($attribute->verify == 0)
                                            <a href="{{ route('attributes.verify', $attribute->id) }}">
                                                <span class="badge badge-danger px-5 py-2">Pending</span>
                                            </a>
                                        @else
                                            <span class="badge badge-success px-5 py-2">Approve</span>
                                        @endif
                                    </td>

                                    <td class="text-right">
                                        @can('view_product_attribute_values')
                                            <a class="btn btn-soft-info btn-icon btn-circle btn-sm"
                                                href="{{ route('attributes.show', $attribute->id) }}"
                                                title="{{ translate('Attribute values') }}">
                                                <i class="las la-cog"></i>
                                            </a>
                                        @endcan
                                        @can('edit_product_attribute')
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                href="{{ route('attributes.edit', ['id' => $attribute->id, 'lang' => 'en']) }}"
                                                title="{{ translate('Edit') }}">
                                                <i class="las la-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete_product_attribute')
                                            <a href="#"
                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                data-href="{{ route('attributes.destroy', $attribute->id) }}"
                                                title="{{ translate('Delete') }}">
                                                <i class="las la-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @can('add_product_attribute')
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h4">{{ translate('Add New Attribute') }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('attributes.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3" id="category">
                                <label for="name">{{ translate('Category') }} </label>

                                <div class="form-group mb-3 text-right">
                                    <select class="form-control aiz-selectpicker" name="category_id[]" id="category_id"
                                        data-selected-text-format="count" data-live-search="true" multiple
                                        data-placeholder="{{ translate('Choose Attributes') }}">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ translate($category->name) }}</option>
                                            @foreach ($category->childrenCategories as $childCategory)
                                                @include('categories.child_category', [
                                                    'child_category' => $childCategory,
                                                ])
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">{{ translate('Name') }}</label>
                                <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name"
                                    class="form-control" required>
                            </div>
                            <div class="form-group mb-3 text-right">
                                <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan
    </div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
