<?php
/**
 * @var $advert \App\Entity\Adverts\Advert\Advert
 */
?>
<div class="form-group col-sm-12">
    @if($advert->photos->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Images</th>
                    <th scope="col">Sort order</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($advert->photos as $key => $media)
                <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>
                        <a data-lightbox="roadtrip" href="{{$media->getUrl()}}">
                            <img src="{{$media->getUrl()}}" width="120">
                        </a>
                    </td>
                    <td>
                        <button type="button"
                                wire:click="sortUp({{ $media->id }})"
                                class="btn btn-info">
                            <i class="fa fa-arrow-up"></i>
                        </button>
                        <button type="button" class="btn btn-warning"
                                wire:click="sortDown({{ $media->id }})">
                            <i class="fa fa-arrow-down"></i>
                        </button>
                    </td>
                    <td>
                        <button type="button"
                                wire:click="setAsMain({{ $media->id }})"
                                class="btn btn-primary {{$media->is_main ? 'disabled' :''}}" {{$media->is_main ? 'disabled' : ''}}>
                            Set as main
                        </button>
                        <button type="button" class="btn btn-danger"
                                wire:click="delete({{ $media->id }})">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
