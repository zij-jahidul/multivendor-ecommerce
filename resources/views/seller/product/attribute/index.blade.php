@extends('seller.layouts.app')

@section('panel_content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="align-items-center">
            <h1 class="h3">{{ translate('All Attributes') }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Attributes') }}</h5>
                </div>
                <div class="card-body">
                    <table class="table aiz-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Name') }}</th>
                                <th>{{ translate('Values') }}</th>
                                <th>{{ translate('Status') }}</th>
                                <th class="text-right">{{ translate('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attributes as $key => $attribute)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $attribute->getTranslation('name') }}</td>
                                    <td>
                                        @foreach ($attribute->attribute_values as $key => $value)
                                            <span
                                                class="badge badge-inline badge-md bg-soft-dark">{{ $value->value }}</span>
                                        @endforeach
                                    </td>

                                    <td>  
                                        @if($attribute->verify == 1)
                                            <span class="badge badge-success px-5 py-2">Approve</span>
                                        @else  
                                            <span class="badge badge-danger px-5 py-2">Pending</span>
                                        @endif
                                    </td>

                                    <td class="text-right">

                                        <a class="btn btn-soft-info btn-icon btn-circle btn-sm"
                                            href="{{ route('seller.sellerattributes.show', $attribute->id) }}"
                                            title="{{ translate('Attribute values') }}">
                                            <i class="las la-cog"></i>
                                        </a>


                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                            href="{{ route('seller.attributes.edit', ['id' => $attribute->id, 'lang' => 'en']) }}"
                                            title="{{ translate('Edit') }}">
                                            <i class="las la-edit"></i>
                                        </a>


                                        <a href="#"
                                            class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                            data-href="{{ route('seller.attributes.destroy', $attribute->id) }}"
                                            title="{{ translate('Delete') }}">
                                            <i class="las la-trash"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Add New Attribute') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('seller.sellerattributes.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label>{{translate('Category')}} <span class="text-danger">*</span></label>
                            <select class="form-control aiz-selectpicker" name="category_ids[]" id="category_id" required multiple onchange="getSellerAttribute()">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ translate($category->name) }}</option>
                                    @foreach ($category->childrenCategories as $childCategory)
                                    @include('categories.child_category', ['child_category' => $childCategory])
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Name') }}</label>
                            <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name" class="form-control" required>
                            @if ($errors->has('name'))
                                <span class="error text-danger">{{ $errors->first('name') }}</span>
                            @endif

                        </div>
                        <div class="form-group mb-3 text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
