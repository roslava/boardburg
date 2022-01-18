@section('filters')

    <div class="row my-4 mx-0 px-0">
        <div class="col-md-12 rounded-3 p-3 border border-success">

            <div class="col-md-12">


                <form class="row row-cols-lg-auto g-3 align-items-center"
                      style="display: flex; justify-content: space-between " action="{{route('skates_base.cat')}}"
                      method="get">
                    @method('get')
                    @csrf

                    <div style="display: flex; max-width: 150px">

                        <div class="col-12 m-2">
                            <label class="visually-hidden " for="inlineFormInputCost1">От</label>
                            <div class="input-group">
                                <div class="input-group-text">От</div>
                                <input type="text" name="price_from" class="form-control" id="inlineFormInputCost1"
                                       placeholder="Цена" value="{{request()->price_from}}">
                            </div>
                        </div>

                        <div class="col-12 m-2">
                            <label class="visually-hidden" for="inlineFormInputCost2">До</label>
                            <div class="input-group">
                                <div class="input-group-text">До</div>
                                <input type="text" name="price_to" class="form-control" id="inlineFormInputCost2"
                                       placeholder="Цена" value="{{request()->price_to}}">
                            </div>
                        </div>
                    </div>


                    <div style="display: flex">


                        <div class="form-check form-switch m-3">
                            <input value="category_1" id="cat1" name="category" class="form-check-input"
                                   type="radio"
                                   style="background-color: #198754; border-color: #198754;"
                                   @if(request()->input('category') == 'category_1') checked @endif>
                            <label for="cat1" class="form-check-label text-white">Доски</label>
                        </div>

                        <div class="form-check form-switch m-3">
                            <input value="category_2" id="cat2" name="category" class="form-check-input"
                                   type="radio"
                                   style="background-color: #198754; border-color: #198754;"
                                   @if(request()->input('category') == 'category_2') checked @endif>
                            <label for="cat2" class="form-check-label text-white">Подвески</label>
                        </div>

                        <div class="form-check form-switch m-3">
                            <input value="category_3" id="cat3" name="category" class="form-check-input"
                                   type="radio"
                                   style="background-color: #198754; border-color: #198754;"
                                   @if(request()->input('category') == 'category_3') checked @endif>
                            <label for="cat3" class="form-check-label text-white">Колеса</label>
                        </div>


                        <div class="form-check form-switch m-3">
                            <input value="category_4" id="cat4" name="category" class="form-check-input"
                                   type="radio"
                                   style="background-color: #198754; border-color: #198754;"
                                   @if(request()->input('category') == 'category_4') checked @endif>
                            <label for="cat4" class="form-check-label text-white">Подшипники</label>
                        </div>


                        <div class="form-check form-switch m-3">
                            <input value="category_5" id="cat5" name="category" class="form-check-input"
                                   type="radio"
                                   style="background-color: #198754; border-color: #198754;"
                                   @if(request()->input('category') == 'category_5') checked @endif
                                   @if(Route::is('skates_base.index')) checked @endif>

                            <label for="cat5" class="form-check-label text-white">Все</label>
                        </div>


                    </div>


                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Фильтр</button>
                    </div>
                </form>


            </div>
        </div>

    </div>
@endsection
@yield('filters')
