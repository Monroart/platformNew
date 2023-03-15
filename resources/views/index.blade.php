@extends('layouts.app')
@section('content')
    <template>
        <div id="app">
            <loader :visible = "isLoading"></loader>
            <main>
{{--                <Spinner class="loader" name="pacman" color="blue"></Spinner>--}}
                <header-main></header-main>
                <section class="pt-0">
                    <div class="container-fluid">
                        <div class="row">
                            <sidebar></sidebar>
                            <router-view></router-view>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </template>
@endsection
<script>
</script>
<style>
</style>

