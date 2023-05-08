<style>
    .loader {
        -webkit-animation: load-out 1s;
        animation: load-out 1s;
        -webkit-animation-fill-mode: forwards;
        animation-fill-mode: forwards;
    }

    @-webkit-keyframes load-out {
        from {
            //top: 0;
            opacity: 1;
        }

        to {
            //top: 100%;
            opacity: 0;
            visibility: hidden;
        }
    }

    @keyframes load-out {
        from {
            //top: 0;
            opacity: 1;
        }

        to {
            //top: 100%;
            opacity: 0;
            visibility: hidden;
        }
    }
</style>