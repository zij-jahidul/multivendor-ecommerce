@extends('backend.layouts.app')

@php
    CoreComponentRepository::instantiateShopRepository();
    CoreComponentRepository::initializeCache();
@endphp

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="align-items-center">
            <h1 class="h3">{{ translate('All Sliders') }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header row gutters-5">
                    <div class="col text-center text-md-left">
                        <h5 class="mb-md-0 h6">{{ translate('Sliders') }}</h5>
                    </div>
                    <div class="col-md-4">
                        <form class="" id="sort_sliders" action="" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="search"
                                    name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset
                                    placeholder="{{ translate('Type name & Enter') }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table aiz-table mb-0">
                        <thead>
                            <tr>
                                <th>ID No.</th>
                                <th>{{ translate('Heading') }}</th>
                                <th>{{ translate('Title') }}</th>
                                <th>{{ translate('Photo') }}</th>
                                <th class="text-right">{{ translate('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $key => $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>{{ Str::limit(translate($slider->heading), 20) }}</td>
                                    <td>{{ Str::limit(translate($slider->title), 20) }}</td>
                                    <td>
                                        <img src="{{ uploaded_asset($slider->photo) }}" alt="{{ translate('slider') }}"
                                            class="h-50px">
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                            href="{{ route('sliders.edit', ['id' => $slider->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                            title="{{ translate('Edit') }}">
                                            <i class="las la-edit"></i>
                                        </a>

                                        <a href="#"
                                            class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                            data-href="{{ route('sliders.destroy', $slider->id) }}"
                                            title="{{ translate('Delete') }}">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="aiz-pagination">
                        {{-- {{ $sliders->appends(request()->input())->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
        @can('add_slider')
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Add New slider') }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="heading">{{ translate('Heading') }}</label>
                                <input type="text" placeholder="{{ translate('Heading') }}" name="heading"
                                    class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="title">{{ translate('Title') }}</label>
                                <input type="text" placeholder="{{ translate('Title') }}" name="title"
                                    class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="logo">{{ translate('Photo') }}
                                    <small>({{ translate('120x80') }})</small></label>
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="photo" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="link">{{ translate('Link') }}</label>
                                <input type="text" placeholder="{{ translate('Link') }}" name="link" class="form-control"
                                    required>
                            </div>

                            <div class="form-group mb-3">

                                <label for="Position Top">{{ translate('Position Top (rem)') }}</label>
                                <input type="text" placeholder="{{ translate('Position Top') }}" name="position_top"
                                    class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Position Right">{{ translate('Position Right (rem)') }}</label>
                                <input type="text" placeholder="{{ translate('Position Right') }}" name="position_right"
                                    class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Position Left">{{ translate('Position Left (rem)') }}</label>
                                <input type="text" placeholder="{{ translate('Position Left') }}" name="position_left"
                                    class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Position Bottom">{{ translate('Position Bottom (rem)') }}</label>
                                <input type="text" placeholder="{{ translate('Position Bottom') }}" name="position_bottom"
                                    class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Position Color">{{ translate('Text Color (Color HEX Code)') }}</label>
                                <input type="text" placeholder="{{ translate('Position Color') }}" name="position_color"
                                    class="form-control">
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

@section('script')
    <script type="text/javascript">
        function sort_sliders(el) {
            $('#sort_sliders').submit();
        }
    </script>
@endsection
