@section('filters')

    <div class="row my-4 mx-0 px-0">
        <div class="col-md-12 p-3 bb-filter" >

            <div class="col-md-12">


                <form class="bb-filter-form"
                      action="{{route('skates_base.cat')}}"
                      method="get">
                    @method('get')
                    @csrf

                    <div class="bb-filter-form__price-input-group">

                            <div class="bb-filter-form__price-input">
                                <div class="bb-filter-form__price-input-key">От</div>
                                <input type="text" name="price_from"
                                       class="live-input bb-filter-form__price-input-value" id="inlineFormInputCost1"
                                       placeholder="Цена" value="{{request()['price_from']}}">
                            </div>


                            <div class="bb-filter-form__price-input">
                                <div class="bb-filter-form__price-input-key">До</div>
                                <input type="text" name="price_to" class="live-input bb-filter-form__price-input-value"
                                       id="inlineFormInputCost2"
                                       placeholder="Цена" value="{{request()['price_to']}}">

                        </div>
                    </div>


                    <div class="bb-filter-form__check-group">

                        <div class="form-check form-switch bb-form-check">
                            <input value="category_1" id="cat1" name="category"
                                   class="form-check-input bb-filter-form__check-input"
                                   type="radio"
                                   @if(request()->input('category') == 'category_1') checked @endif>
                            <label for="cat1" class="form-check-label text-white">Доски</label>
                        </div>


                        <div class="form-check form-switch bb-form-check">
                            <input value="category_2" id="cat2" name="category"
                                   class="form-check-input bb-filter-form__check-input"
                                   type="radio"
                                   @if(request()->input('category') == 'category_2') checked @endif>
                            <label for="cat2" class="form-check-label text-white">Подвески</label>
                        </div>

                        <div class="form-check form-switch bb-form-check">
                            <input value="category_3" id="cat3" name="category"
                                   class="form-check-input bb-filter-form__check-input"
                                   type="radio"
                                   @if(request()->input('category') == 'category_3') checked @endif>
                            <label for="cat3" class="form-check-label text-white">Колеса</label>
                        </div>


                        <div class="form-check form-switch bb-form-check">
                            <input value="category_4" id="cat4" name="category"
                                   class="form-check-input bb-filter-form__check-input"
                                   type="radio"
                                   @if(request()->input('category') == 'category_4') checked @endif>
                            <label for="cat4" class="form-check-label text-white">Подшипники</label>
                        </div>


                        <div class="form-check form-switch bb-form-check">
                            <input value="category_5" id="cat5" name="category"
                                   class="form-check-input bb-filter-form__check-input"
                                   type="radio"
                                   @if(request()->input('category') == 'category_5') checked @endif
                                   @if(Route::is('skates_base.index')) checked @endif>

                            <label for="cat5" class="form-check-label text-white">Все</label>
                        </div>


                    </div>



                        <button type="submit" class="btn btn-success bb-filter-form__btn">Фильтр</button>

                </form>


            </div>
        </div>

    </div>
@endsection
@yield('filters')
