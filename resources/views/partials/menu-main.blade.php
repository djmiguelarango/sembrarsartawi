<div class="navbar navbar-default" id="navbar-second">
    <div class="navbar-boxed">
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i
                            class="icon-menu7"></i></a></li>
        </ul>
        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="icon-home2 position-left"></i> Inicio
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Descargar Formularios <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu width-200">
                        @foreach(auth()->user()->retailerUser->retailer->retailerProducts as $retailerProduct)
                            @var $flag_product = false;

                            @if($retailerProduct->type == 'MP')
                                @if(auth()->user()->profile->first()->slug === 'COP'
                                    && $retailerProduct->companyProduct->ad_company_id === auth()->user()->retailerUser->company->id)
                                    @var $flag_product = true;
                                @elseif(auth()->user()->profile->first()->slug === 'SEP')
                                    @if(auth()->user()->retailerUser->products()->where('ad_products.id', $retailerProduct->companyProduct->product->id)->count() === 1)
                                        @var $flag_product = true;
                                    @endif
                                @endif

                                @if($flag_product)
                                    <li class="dropdown-header">{{ $retailerProduct->companyProduct->product->name }}</li>
                                    @foreach ($retailerProduct->forms as $form)
                                        <li>
                                            <a href="{{ asset($form->file) }}" target="_blank">
                                                <i class="icon-align-center-horizontal"></i> {{ $form->title }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </li>

                @if (auth()->user()->profile->first()->slug === 'SEP')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Productos <span class="caret"></span></a>
                        <ul class="dropdown-menu width-200">
                            @foreach(auth()->user()->retailerUser->retailer->retailerProducts as $retailerProduct)
                                @var $flag_product = false;

                                @if($retailerProduct->type == 'MP')
                                    @if(auth()->user()->retailerUser->products()->where('ad_products.id', $retailerProduct->companyProduct->product->id)->count() === 1)
                                        @var $flag_product = true;
                                    @endif

                                    @if($flag_product)
                                        <li class="dropdown-submenu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-list-unordered"></i> {{ $retailerProduct->companyProduct->product->name }}
                                            </a>
                                            <ul class="dropdown-menu">
                                                @if(request()->route()->hasParameter('client'))
                                                    @var $client = encode($client->id);
                                                @else
                                                    @var $client = ''
                                                @endif

                                                @if(request()->route()->hasParameter('detail_id'))
                                                    @var $detail_id = request()->get('detail_id')
                                                @else
                                                    @var $detail_id = ''
                                                @endif

                                                @if(request()->route()->hasParameter('header_id'))
                                                    @var $header_id = $header_id
                                                @else
                                                    @var $header_id = ''
                                                @endif

                                                @if(request()->route()->hasParameter('header'))
                                                    @var $header = encode($header->id);
                                                @else
                                                    @var $header = ''
                                                @endif

                                                @if(request()->route()->hasParameter('detail'))
                                                    @var $detail = encode($detail->id);
                                                @else
                                                    @var $detail = ''
                                                @endif

                                                @if(request()->route()->hasParameter('sp_id'))
                                                    @var $sp_id = $sp_id
                                                @else
                                                    @var $sp_id = ''
                                                @endif

                                                <li class="{{
                                                    Request::is('de/'.encode($retailerProduct->id).'/create') ? 'active' :
                                                    Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/list') ? 'active':
                                                    Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/client/create') ? 'active':
                                                    Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/client/create/'.$client.'') ? 'active':
                                                    Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/client/'.$detail_id.'/question/create') ? 'active':
                                                    Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/client/edit/'.$detail_id.'') ? 'active':
                                                    Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/result') ? 'active':
                                                    Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/edit') ? 'active':
                                                    Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/beneficiary/create/'.$detail.'') ? 'active':
                                                    Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/client/'.$detail_id.'/question/edit') ? 'active':
                                                    Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/issuance') ? 'active':
                                                    Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/vi/'.$sp_id.'') ? 'active':
                                                    Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/vi/'.$sp_id.'/create') ? 'active':
                                                    Request::is('de/'.encode($retailerProduct->id).'/'.$header.'/balance/edit/'.$detail.'') ? 'active':
                                                    ''
                                                   }}

                                                @if($retailerProduct->companyProduct->product->code === 'au')
                                                {{ request()->route()->getName() === 'au.create' ? 'active' : '' }}
                                                {{ request()->route()->getName() === 'au.vh.lists' ? 'active' : '' }}
                                                {{ request()->route()->getName() === 'au.result' ? 'active' : '' }}
                                                {{ request()->route()->getName() === 'au.edit' ? 'active' : '' }}
                                                @endif
                                                @if($retailerProduct->companyProduct->product->code === 'mr')
                                                {{ request()->route()->getName() === 'td.create' ? 'active' : '' }}
                                                {{ request()->route()->getName() === 'td.vh.lists' ? 'active' : '' }}
                                                {{ request()->route()->getName() === 'td.result' ? 'active' : '' }}
                                                {{ request()->route()->getName() === 'td.edit' ? 'active' : '' }}
                                                @endif
                                                        ">
                                                    <a href="{{ route($retailerProduct->companyProduct->product->code . '.create', ['rp_id' => encode($retailerProduct->id)]) }}">Cotizar</a>
                                                </li>
                                                <li class="{{ request()->route()->getName() === $retailerProduct->companyProduct->product->code . '.cancel.lists' ? 'active' : '' }}">
                                                    <a href="{{ route($retailerProduct->companyProduct->product->code . '.cancel.lists', ['rp_id' => encode($retailerProduct->id)]) }}">Anular
                                                        Póliza</a>
                                                </li>
                                                <li class="{{ request()->route()->getName() === $retailerProduct->companyProduct->product->code. '.pre.approved.lists' ? 'active' : '' }}">
                                                    <a href="{{ route($retailerProduct->companyProduct->product->code . '.pre.approved.lists', ['rp_id' => encode($retailerProduct->id)]) }}">Solicitudes
                                                        Preaprobadas</a>
                                                </li>
                                                <li class="{{ request()->route()->getName() === $retailerProduct->companyProduct->product->code . '.issue.lists' ? 'active' : '' }}">
                                                    <a href="{{ route($retailerProduct->companyProduct->product->code . '.issue.lists', ['rp_id' => encode($retailerProduct->id)]) }}">Emitir
                                                        Solicitudes</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <span class="caret"></span></a>
                    <ul class="dropdown-menu width-200">
                        @foreach(auth()->user()->retailerUser->retailer->retailerProducts as $retailerProduct)
                            @var $flag_product = false;

                            @if($retailerProduct->type == 'MP')
                                @if(auth()->user()->profile->first()->slug === 'COP'
                                    && $retailerProduct->companyProduct->ad_company_id === auth()->user()->retailerUser->company->id)
                                    @var $flag_product = true;
                                @elseif(auth()->user()->profile->first()->slug === 'SEP')
                                    @if(auth()->user()->retailerUser->products()->where('ad_products.id', $retailerProduct->companyProduct->product->id)->count() === 1)
                                        @var $flag_product = true;
                                    @endif
                                @endif

                                @if($flag_product)
                                    <li class="">
                                        @var $route_report = '';

                                        @if($retailerProduct->companyProduct->product->code == 'de')
                                            @var $route_report = 'report_general';
                                        @endif
                                        @if($retailerProduct->companyProduct->product->code == 'au')
                                            @var $route_report = 'auto_report_general';
                                        @endif
                                        @if($retailerProduct->companyProduct->product->code == 'td')
                                            @var $route_report = 'td_report_general';
                                        @endif
                                        <a href="{{ route('report.' . $route_report, [
                                            'id_comp' => encode($retailerProduct->id)
                                        ]) }}">
                                            <i class="icon-list-unordered"></i> {{ $retailerProduct->companyProduct->product->name }}
                                        </a>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <span><i class="icon-user"></i> {{ auth()->user()->full_name }}</span>
                        <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        {{--<li><a href="#"><i class="icon-user-plus"></i> Perfil</a></li>--}}
                        {{--<li><a href="#"><i class="icon-lock5"></i> Cambiar clave</a></li>--}}
                        <li class="divider"></li>
                        {{--<li><a href="#"><i class="icon-phone"></i> Telefono Agencia</a></li>--}}
                        <li><a href="{{ route('auth.logout') }}"><i class="icon-switch2"></i> Salir</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>