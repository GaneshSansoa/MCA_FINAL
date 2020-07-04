<?php
include_once('config/config.php');
include_once(ROOT_PATH.'header.php');

?>
   <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                
                <section id="my-citation">
                    <div class="spacer">
                        <div class="container">
                            <h4>My Citations</h4>
                            <h2>No Citations Generated!</h2>
                            <div class="row justify-content-center">
                                
                                <div class="col-md-6">
                                    <div class="cite-results">
                                        <div class="card p-md-4 p-3">
                                           <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Explicabo, corporis!</p>
                                            <span>lol</span>
                                        </div>
                                    </div>
                                    <div class="cite-results">
                                        <div class="card p-md-4 p-3">
                                           <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Explicabo, corporis!</p>
                                            <span>lol</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <script>
    console.log(localStorage.counter);
    console.log(localStorage.citations);
</script>
<?php
include_once(ROOT_PATH.'footer.php');
?>