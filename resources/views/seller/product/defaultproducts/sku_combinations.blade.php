@if(count($combinations[0]) > 0)
<table class="table table-bordered aiz-table">
	<thead>
		<tr>
			<td class="text-center">
				{{translate('Variant')}}
			</td>
			<td class="text-center">
				{{translate('Variant Price')}}
			</td>
			<td class="text-center" data-breakpoints="lg">
				{{translate('SKU')}}
			</td>
			<td class="text-center" data-breakpoints="lg">
				{{translate('Quantity')}}
			</td>
			<td class="text-center" data-breakpoints="lg">
				{{translate('Photo')}}
			</td>
		</tr>
	</thead>
	<tbody>
	@php 
	$check=App\Models\AttributeValue::first();
	@endphp
	@foreach ($combinations as $key => $combination)
		@php
			$sku_rand = rand(999999999,999999999999);
			$sku = '';

			$str = '';
			foreach ($combination as $key => $item){
				if($key > 0 ){
					$str .= '-'.str_replace(' ', '', $item);
					if($sku == ''){
						$sku .= $sku_rand;
					}
				}
				else{
					if($colors_active == 1){
						$color_name = \App\Models\Color::where('code', $item)->first()->name;
						$str .= $color_name;
						if($sku == ''){
							$sku .= $sku_rand;
						}
					}
					else{
						$str .= str_replace(' ', '', $item);
						if($sku == ''){
							$sku .= $sku_rand;
						}
					}
				}
			}
		@endphp
		
		@if(strlen($str) > 0)
			
			<tr class="variant">
				<td>
					<label for="" class="control-label">{{ $str }} </label>
				</td>
				<td>
					<input type="number" lang="en" name="price_{{ $str }}" value="{{ $unit_price }}" min="0" step="0.01" class="form-control" required >
				</td>
				<td>
					<input type="text" name="sku_{{ $str }}" value="{{ $sku }}" class="form-control" readonly>
				</td>

				


				<td>
					<input type="number" lang="en" name="qty_{{ $str }}" value="10" min="0" step="1" class="form-control" required>
				</td>
				<td>
					<div class=" input-group " data-toggle="aizuploader" data-type="image">
						<div class="input-group-prepend">
							<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
						</div>
						<div class="form-control file-amount text-truncate">{{ translate('Choose File') }}</div>
						<input type="hidden" name="img_{{ $str }}" class="selected-files">
					</div>
					<div class="file-preview box sm"></div>
				</td>
			</tr>
		
		@endif
	@endforeach
	</tbody>
</table>
@endif
