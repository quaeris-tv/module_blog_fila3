<div class="row mb-4 gape">
    @foreach($_theme->getArticlesType($type) as $article)
        <div class="col-sm-6 col-md-4 col-xl-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
            <div class="card mb-4">
                <div class="card__header d-flex align-items-center gap-2 justify-content-between mb20">
                    <div class="card__right">
                        <a class="card__btn f12" href="javascript:void(0)">{{ $article->category->title }}</a>
                        {{-- <span class="f12">$1.8m Vol.</span>
                        <span class="f12">$389.6k Liq.</span> --}}
                    </div>
                    <div class="card__left">
                        <i class="material-symbols-outlined search-style2">star
                    </i>
                    </div>
                </div>
                <div class="card__thumb mb-3">
                    <a href="javascript:void(0)">
                    <img src="{{ $article->getMainImage() }}" alt="Image"  style="aspect-ratio: 4/2;"></a>
                </div>
                <a href="javascript:void(0)">
                    <h5 class="card__title mb20">
                        {{ $article->title }}
                    </h5>
                </a>
                <div class="card__footer d-flex gap-2 flex-wrap align-items-center justify-content-between">
                    <div class="card__yesno d-flex align-items-center gap-3">
                        @foreach($article->getOptionRatingsIdTitle() as $rating)
                            @if($loop->index == 0)
                                <span class="card__yes d-block">{{ $rating }}</span>
                            @elseif($loop->index == 1)
                                <span class="card__no">{{ $rating }}</span>
                            @elseif($loop->index == 2)
                                <span class="no_style">More</span>
                            @endif
                        @endforeach
                    {{-- <span class="card__yes d-block">Yes 14¢</span>
                    <span class="card__no">No 86¢</span> --}}
                    </div>
                    <div class="card__market">
                        <a href="{{ $this->url('show', ['record' => $article]) }}">View market</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- <div class="col-sm-6 col-md-4 col-xl-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
      <div class="card mb-4">
        <div class="card__header d-flex align-items-center gap-2 justify-content-between mb20">
          <div class="card__right">
            <a class="card__btn f12" href="javascript:void(0)">Trump</a>
            <span class="f12">$1.8m Vol.</span>
            <span class="f12">$389.6k Liq.</span>
          </div>
          <div class="card__left">
            <i class="material-symbols-outlined search-style2">star
            </i>
          </div>
        </div>
        <div class="card__thumb mb-3">
          <a href="javascript:void(0)">
            <img src="{{ $_theme->asset('pub_theme::assets/images/trump.png') }}" alt="Image">
          </a>
        </div>
        <a href="javascript:void(0)">
          <h5 class="card__title mb20">
            Will Donald Trump be President of the USA on...?
          </h5>
        </a>
        <div class="card__footer d-flex gap-2 flex-wrap align-items-center justify-content-between">
          <div class="card__yesno d-flex align-items-center gap-2 gap-xxl-3">
            <span class="card__yes d-block">Yes 14¢</span>
            <span class="card__no">No 86¢</span>
          </div>
          <div class="card__market">
            <a href="volume.html">View market</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xl-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
      <div class="card mb-4">
        <div class="card__header d-flex align-items-center gap-2 justify-content-between mb20">
          <div class="card__right">
            <a class="card__btn f12" href="javascript:void(0)">US politics</a>
            <span class="f12">$1.8m Vol.</span>
            <span class="f12">$389.6k Liq.</span>
          </div>
          <div class="card__left">
            <i class="material-symbols-outlined search-style2">star
            </i>
          </div>
        </div>
        <div class="card__thumb mb-3">
          <a href="javascript:void(0)">
            <img src="{{ $_theme->asset('pub_theme::assets/images/biden.png') }}" alt="Image"></a>
        </div>
        <a href="javascript:void(0)">
          <h5 class="card__title mb20">
            Will Joe Biden be President of the United States on...?
          </h5>
        </a>
        <div class="card__footer d-flex gap-2 flex-wrap align-items-center justify-content-between">
          <div class="card__yesno d-flex align-items-center gap-3">
            <span class="card__yes d-block">Yes 14¢</span>
            <span class="card__no">No 86¢</span>
          </div>
          <div class="card__market">
            <a href="volume.html">View market</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xl-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
      <div class="card mb-4">
        <div class="card__header d-flex align-items-center gap-2 justify-content-between mb20">
          <div class="card__right">
            <a class="card__btn f12" href="javascript:void(0)">Elections</a>
            <span class="f12">$1.8m Vol.</span>
            <span class="f12">$389.6k Liq.</span>
          </div>
          <div class="card__left">
            <i class="material-symbols-outlined search-style2">star
            </i>
          </div>
        </div>
        <div class="card__thumb mb-3">
          <a href="javascript:void(0)">
            <img src="{{ $_theme->asset('pub_theme::assets/images/2023.png') }}" alt="Image"></a>
        </div>
        <a href="javascript:void(0)">
          <h5 class="card__title mb20">
            Who win the U.S. 2024 Republican nomination?
          </h5>
        </a>
        <div class="card__footer d-flex gap-2 flex-wrap align-items-center justify-content-between">
          <div class="card__yesno d-flex align-items-center gap-3">
            <span class="card__yes d-block">Yes 14¢</span>
            <span class="card__no">No 86¢</span>
          </div>
          <div class="card__market">
            <a href="volume.html">View market</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-4 col-xl-4 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">
      <div class="card mb-4">
        <div class="card__header d-flex align-items-center gap-2 justify-content-between mb20">
          <div class="card__right">
            <a class="card__btn f12" href="javascript:void(0)">Space</a>
            <span class="f12">$1.8m Vol.</span>
            <span class="f12">$389.6k Liq.</span>
          </div>
          <div class="card__left">
            <i class="material-symbols-outlined search-style2">star
            </i>
          </div>
        </div>
        <div class="card__thumb mb-3">
          <a href="javascript:void(0)">
            <img src="{{ $_theme->asset('pub_theme::assets/images/alian.png') }}" alt="Image"></a>
        </div>
        <a href="javascript:void(0)">
          <h5 class="card__title mb20">
            Will the US confirm that aliens exist by August 31?
          </h5>
        </a>
        <div class="card__footer d-flex gap-2 flex-wrap align-items-center justify-content-between">
          <div class="card__yesno d-flex align-items-center gap-3">
            <span class="card__yes d-block">Yes 14¢</span>
            <span class="card__no">No 86¢</span>
          </div>
          <div class="card__market">
            <a href="volume.html">View market</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xl-4 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">
      <div class="card mb-4">
        <div class="card__header d-flex align-items-center gap-2 justify-content-between mb20">
          <div class="card__right">
            <a class="card__btn f12" href="javascript:void(0)">Elections</a>
            <span class="f12">$1.8m Vol.</span>
            <span class="f12">$389.6k Liq.</span>
          </div>
          <div class="card__left">
            <i class="material-symbols-outlined search-style2">star
            </i>
          </div>
        </div>
        <div class="card__thumb mb-3">
          <a href="javascript:void(0)">
            <img src="{{ $_theme->asset('pub_theme::assets/images/eoy.png') }}" alt="Image">
          </a>
        </div>
        <a href="javascript:void(0)">
          <h5 class="card__title mb20">
            Will there be a Senate vacancy in Pennsylvania by EOY?
          </h5>
        </a>
        <div class="card__footer d-flex gap-2 flex-wrap align-items-center justify-content-between">
          <div class="card__yesno d-flex align-items-center gap-3">
            <span class="card__yes d-block">Yes 14¢</span>
            <span class="card__no">No 86¢</span>
          </div>
          <div class="card__market">
            <a href="volume.html">View market</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xl-4 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">
      <div class="card mb-4">
        <div class="card__header d-flex align-items-center gap-2 justify-content-between mb20">
          <div class="card__right">
            <a class="card__btn f12" href="javascript:void(0)">Soccer</a>
            <span class="f12">$1.8m Vol.</span>
            <span class="f12">$389.6k Liq.</span>
          </div>
          <div class="card__left">
            <i class="material-symbols-outlined search-style2">star
            </i>
          </div>
        </div>
        <div class="card__thumb mb-3">
          <a href="javascript:void(0)">
            <img src="{{ $_theme->asset('pub_theme::assets/images/messi.png') }}" alt="Image"></a>
        </div>
        <a href="javascript:void(0)">
          <h5 class="card__title mb20">
            Will Messi sign for Barcelona?
          </h5>
        </a>
        <div class="card__footer d-flex gap-2 flex-wrap align-items-center justify-content-between">
          <div class="card__yesno d-flex align-items-center gap-3">
            <span class="card__yes d-block">Yes 14¢</span>
            <span class="card__no">No 86¢</span>
          </div>
          <div class="card__market">
            <a href="volume.html">View market</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-4 col-xl-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
      <div class="card mb-4">
        <div class="card__header d-flex align-items-center gap-2 justify-content-between mb20">
          <div class="card__right">
            <a class="card__btn f12" href="javascript:void(0)">AI</a>
            <span class="f12">$1.8m Vol.</span>
            <span class="f12">$389.6k Liq.</span>
          </div>
          <div class="card__left">
            <i class="material-symbols-outlined search-style2">star
            </i>
          </div>
        </div>
        <div class="card__thumb mb-3">
          <a href="javascript:void(0)">
            <img src="{{ $_theme->asset('pub_theme::assets/images/chatgpt.png') }}" alt="Image"></a>
        </div>
        <a href="javascript:void(0)">
          <h5 class="card__title mb20">
            Will GPT-4 have 500b+ parameters?
          </h5>
        </a>
        <div class="card__footer d-flex gap-2 flex-wrap align-items-center justify-content-between">
          <div class="card__yesno d-flex align-items-center gap-3">
            <span class="card__yes d-block">Yes 14¢</span>
            <span class="card__no">No 86¢</span>
          </div>
          <div class="card__market">
            <a href="volume.html">View market</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xl-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
      <div class="card mb-4">
        <div class="card__header d-flex align-items-center gap-2 justify-content-between mb20">
          <div class="card__right">
            <a class="card__btn f12" href="javascript:void(0)">Elections</a>
            <span class="f12">$1.8m Vol.</span>
            <span class="f12">$389.6k Liq.</span>
          </div>
          <div class="card__left">
            <i class="material-symbols-outlined search-style2">star
            </i>
          </div>
        </div>
        <div class="card__thumb mb-3">
          <a href="javascript:void(0)">
            <img src="{{ $_theme->asset('pub_theme::assets/images/bts.png') }}" alt="Image"></a>
        </div>
        <a href="javascript:void(0)">
          <h5 class="card__title mb20">
            Will Prigozhin be arrested by July 15? Will Prigozhin be
            arrested by July 15?
          </h5>
        </a>
        <div class="card__footer d-flex gap-2 flex-wrap align-items-center justify-content-between">
          <div class="card__yesno d-flex align-items-center gap-3">
            <span class="card__yes d-block">Yes 14¢</span>
            <span class="card__no">No 86¢</span>
          </div>
          <div class="card__market">
            <a href="volume.html">View market</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xl-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
      <div class="card mb-4">
        <div class="card__header d-flex align-items-center gap-2 justify-content-between mb20">
          <div class="card__right">
            <a class="card__btn f12" href="javascript:void(0)">Finance</a>
            <span class="f12">$1.8m Vol.</span>
            <span class="f12">$389.6k Liq.</span>
          </div>
          <div class="card__left">
            <i class="material-symbols-outlined search-style2">star
            </i>
          </div>
        </div>
        <div class="card__thumb mb-3">
          <a href="javascript:void(0)">
            <img src="{{ $_theme->asset('pub_theme::assets/images/br.png') }}" alt="Image"></a>
        </div>
        <a href="javascript:void(0)">
          <h5 class="card__title mb20">
            Will the SEC approve BlackRock's by August 31?
          </h5>
        </a>
        <div class="card__footer d-flex gap-2 flex-wrap align-items-center justify-content-between">
          <div class="card__yesno d-flex align-items-center gap-3">
            <span class="card__yes d-block">Yes 14¢</span>
            <span class="card__no">No 86¢</span>
          </div>
          <div class="card__market">
            <a href="volume.html">View market</a>
          </div>
        </div>
      </div>
    </div> --}}
</div>