    <!-- More Choose Js Button  -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Customer Choice Options</h5>
                <div>
                    <input type="button" class="btn btn-danger btn-sm" id="show-form" value="Hide From">
                    <input type="button" class="btn btn-success btn-sm" id="hide-form" value="Show From">
                </div>
            </div>

            <div id="hide-full-div" style="display:none">
                <div class="col-lg-2" style="padding-top: 45px;">
                    <input type="button" class="btn btn-success btn-sm" id="add-row" value="Add Row">
                    <input type="button" class="btn btn-danger btn-sm" id="remove-row" value="Delete Row">
                </div>

                <div class="card-body">
                    <!-- one field custom this play div2 -->
                    <div id="row_field">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- More Choose Js End -->    

    <!-- script js code -->
    <!-- Customer choice option -->
    <script>
        $(document).ready(function(){
            $("#add-row").click(function(){
                var markup = `
                <div class="add-new-form">
                    <div class="border p-2 my-2">
                        <div class="form-group row">
                            <div class="col-md-6 col-from-label">
                                <div class="row">
                                    <label class="col-md-1 col-from-label mt-2">{{translate('Title : ')}}</label>
                                    <div class="col-md-11">
                                        <input type="number" placeholder="{{ translate('Title') }}" name="title" class="form-control">
                                    </div> 
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-2 col-from-label mt-2">{{translate('Type : ')}}</label>
                                    <div class="col-md-10">
                                        <select class="form-control aiz-selectpicker" name="category_id" data-live-search="true">
                                            <option selected>--Select Option--</option>
                                            <option value="#">One Option</option>
                                            <option value="#">Two Option</option>
                                            <option value="#">Three Option</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="form-group row">
                            <div class="col-md-4 col-from-label">
                                <div class="row">
                                    <label class="col-md-2 col-from-label mt-2">{{translate('Name : ')}}</label>
                                    <div class="col-md-10">
                                        <input type="number" placeholder="{{ translate('Name') }}" name="title" class="form-control">
                                    </div> 
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="row">
                                    <label class="col-md-3 col-from-label mt-2">{{translate('Quantity : ')}}</label>
                                    <div class="col-md-9">
                                        <input type="number" placeholder="{{ translate('Quantity') }}" name="title" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-from-label">
                                <div class="row">
                                    <label class="col-md-3 col-from-label mt-2">{{translate('Price : ')}}</label>
                                    <div class="col-md-9">
                                        <input type="number" placeholder="{{ translate('Price') }}" name="title" class="form-control">
                                    </div> 
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <select class="form-control aiz-selectpicker" name="category_id" data-live-search="true">
                                                <option selected>--Select Option--</option>
                                                <option value="#">In Stock</option>
                                                <option value="#">Out Stock</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="checkbox" name="record">
                    </div>
                </div>
            `;

                $("#row_field").append(markup);
            });
            
            // Find and remove selected table rows
            $("#remove-row").click(function(){
                $("#row_field").find('input[name="record"]').each(function(){
                    if($(this).is(":checked")){
                        $(this).parents(".add-new-form").remove();
                    }
                });
            });

            $("#show-form").click(function(){
                $("#hide-full-div").hide();
            });
            $("#hide-form").click(function(){
                $("#hide-full-div").show();
            });
        });    
    </script>
    <!-- extra code -->
        <!-- div2 start -->
        <div class="border p-2">
            <div class="form-group row">
                    <div class="col-md-6 col-from-label">
                        <div class="row">
                            <label class="col-md-1 col-from-label mt-2">{{translate('Title : ')}}</label>
                            <div class="col-md-11">
                                <input type="number" placeholder="{{ translate('Title') }}" name="title" class="form-control">
                            </div> 
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-2 col-from-label mt-2">{{translate('Type : ')}}</label>
                            <div class="col-md-10">
                                <select class="form-control aiz-selectpicker" name="category_id" data-live-search="true">
                                    <option selected>--Select Option--</option>
                                    <option value="#">One Option</option>
                                    <option value="#">Two Option</option>
                                    <option value="#">Three Option</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div> 
            <div class="form-group row">
                <div class="col-md-4 col-from-label">
                    <div class="row">
                        <label class="col-md-2 col-from-label mt-2">{{translate('Name : ')}}</label>
                        <div class="col-md-10">
                            <input type="number" placeholder="{{ translate('Name') }}" name="title" class="form-control">
                        </div> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="row">
                        <label class="col-md-3 col-from-label mt-2">{{translate('Quantity : ')}}</label>
                        <div class="col-md-9">
                            <input type="number" placeholder="{{ translate('Quantity') }}" name="title" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-from-label">
                    <div class="row">
                        <label class="col-md-3 col-from-label mt-2">{{translate('Price : ')}}</label>
                        <div class="col-md-9">
                            <input type="number" placeholder="{{ translate('Price') }}" name="title" class="form-control">
                        </div> 
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="row">
                    
                        <div class="col-md-12">
                            <select class="form-control aiz-selectpicker" name="category_id" data-live-search="true">
                                    <option selected>--Select Option--</option>
                                    <option value="#">In Stock</option>
                                    <option value="#">Out Stock</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    <!-- div2 end-->

