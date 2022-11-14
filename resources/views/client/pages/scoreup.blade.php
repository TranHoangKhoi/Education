@extends('client.layout.clientLayout')
@section('custtomCss')
    <link rel="stylesheet" href="{{asset('assets/client')}}/css/scoreup.css">
@endsection

@section('content')
    <div class='content'>
        <div class='wrapper'>
            @include('client.pages.checkSubject')

            {{-- <div class='lecturers-semester', 'flex-end'>
                <form class='form-groups', 'rows', 'c-6'>
                    <div class='search-student'>
                        <input placeholder='VD: PC02104' />
                    </div>
                    <div class='search__btn'>
                        <button type=""><FontAwesomeIcon icon={faMagnifyingGlass} /></button>
                    </div>
                </form>
            </div> --}}
        </div >
    </div >
@endsection