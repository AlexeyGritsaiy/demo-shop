<div class="col-md-6">
    <div class="box-header">
        <h3 class="box-title">Select product</h3>
    </div>
    <div class="card">
        <div class="input-group input-group-sm">
            <select class="form-control" wire:model="productId">
                <option>Select product</option>
                @foreach($adverts as $advert)
                    <option value="{{$advert->id}}">{{$advert->title}}</option>
                @endforeach
            </select>
            <span class="input-group-append">
                <a href="#" class="btn btn-info" wire:click="addProduct">Add</a>
              </span>
        </div>
    </div>
    <!-- /.card -->
</div>
<!-- /.col-md-6 -->

