@props(['data'])
@php
    $cols = 1;
@endphp
<div class="p-0 overflow-x-auto flex justify-center">
    <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
      <thead class="align-bottom uppercase">
        <tr>
          @foreach ( $data['columns'] as $column )
            @if ( !in_array($column, ['created_at', 'updated_at', 'deleted_at']) )
                @php
                    $cols += 1;
                @endphp
                <th class="hover:bg-sky-700 px-6 py-3 font-bold text-center align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">{{ $column }}</th>
            @endif
          @endforeach
          <th class="px-6 py-3 font-bold text-center align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ( $data['data'] as $inx => $row )
            <tr class="hover:bg-sky-700 {{ $data['action'] }}-{{ $inx }}"
                @foreach ( $row->getAttributes() as $col => $cell )
                    @if ( !in_array($col, ['created_at', 'updated_at', 'deleted_at']) )
                        data-{{ $col }}="{{ $cell }}"
                    @endif
                @endforeach
            >
                @php
                    $showToggle = 100;
                    $column = '';
                @endphp
                @foreach ( $row->getAttributes() as $col => $cell )
                    @php
                        $classes = '';
                        if( in_array( $col, ['id', 'state', 'position'] ) ){
                            $classes .= ' text-center';
                            $showToggle = ( in_array( $col, ['state'] ) ) ? $cell : 1000;
                            $column = ( in_array( $col, ['state'] ) ) ? $col : '';
                        }
                    @endphp
                    @if ( !in_array($col, ['created_at', 'updated_at', 'deleted_at']) )
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent {{ $classes }}">
                            @if ( in_array( $col, ['state'] ) )
                                @if ( $cell == 1)
                                    <span class="px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-teal-500">
                                        {{ __( 'Enable' ) }}
                                @else
                                    <span class="px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-pink-500">
                                        {{ __( 'Disable' ) }}
                                @endif
                                    </span>
                            @else
                                <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $cell }}</h6>
                            @endif
                        </td>
                    @endif
                @endforeach
                <td class="flex justify-center p-2 bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent state-{{ $showToggle }}">
                    {{-- UPDATE --}}
                    <a href="javascript:;" data-target="{{ $data['action'] }}-{{ $inx }}" class="mx-1 w-5 h-5 text-xs font-semibold leading-tight dark:opacity-80 text-cyan-400 action edit-row" title="Edit {{ $data['action'] }}">@svg("pencil-square")</a>
                    {{-- DELETE --}}
                    <form method="POST" action="{{ $data['route'] }}/{{ $row->id }}">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="mx-1 w-5 h-5 text-xs font-semibold leading-tight dark:opacity-80 text-rose-600" title="Delete {{ $data['action'] }}" onclick="return confirm('Are you sure?')">
                            @svg("x-square")
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td colspan="{{ $cols }}" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    {{ __("No $data[action] found") }}
                </td>
            </tr>
        @endforelse
      </tbody>
      <tfoot>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td colspan="{{ $cols }}" >
                <form method="POST" action="{{ $data['route'] }}" class="w-full flex justify-between p-4 form-inline-crud hidden">
                    @csrf
                    @method("POST")
                    @foreach ( $data['columns'] as $column )
                    @if ( !in_array($column, ['created_at', 'updated_at', 'deleted_at']) )
                        <label for="{{$column}}" class="block @if($column == 'state') text-center @endif @if($column == 'id') hidden @endif">
                            <span class="block text-xs text-white uppercase border-b mb-2 border-gray-500">{{$column}}</span>
                        @switch($column)
                            @case('id')
                                <input type="hidden" name="{{$column}}" id="{{$column}}" data-realtype="hidden" class="border-slate-200 text-slate-500 rounded-md caret-pink-500" placeholder="Enter {{$column}}">
                                @break
                            @case('name')
                                <input type="text" name="{{$column}}" id="{{$column}}" data-realtype="text" class="border-slate-200 text-slate-500 rounded-md caret-pink-500" placeholder="Enter {{$column}}" required>
                                @break
                            @case('state')
                                <input type="checkbox" id="_checkbox" data-target="{{$column}}" class="appearance-none checked:bg-lime-700 p-3"/>
                                <input type="hidden" name="{{$column}}" id="{{$column}}" data-realtype="checkbox" class="appearance-none checked:bg-lime-700 p-3" value="0"/>
                                @break
                            @case('position')
                                <input type="number" name="{{$column}}" id="{{$column}}" data-realtype="number" class="border-slate-200 text-slate-500 rounded-md caret-pink-500" placeholder="Enter {{$column}}" required>
                                @break
                            @default
                        @endswitch
                        </label>
                    @endif
                @endforeach
                    <label class="block mt-8">
                        <x-button class="ml-4 text-white" id="submit-form">
                            {{ __("Save $data[action]") }}
                        </x-button>
                    </label>
                </form>
            </td>
        </tr>
      </tfoot>
    </table>
  </div>