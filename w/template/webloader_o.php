<style> .loader {
        position: fixed;
        background-color: black;
        opacity: 1;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 10;
    }
</style>

<style>
    .loaderI {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        margin:auto;
        left:0;
        right:0;
        top:0;
        bottom:0;
        position:fixed;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="loader" style="border: 5px solid; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 10px;">

    <div class="loaderI"></div>

</div>