<div id="page-content" class="header-clear">
    <div id="page-content-scroll"><!--Enables this element to be scrolled --> 
<div class="decoration decoration-margins"></div>
        
        <div class="decoration decoration-margins"></div>
    <form action="<?= base_url() ?>index.php/passinggrade/hasilpassing" method="post">

        <div class="content">
        <label class="control-label col-sm-4">Kesulitan</label>
            <div class="select-box">
                <select name="pass" id="pass" class="form-control">
                    <option value="0">--Pilih--</option>
                    <option value="1">21%-25%</option>
                    <!-- <option value="2">26%-30%</option>
                    <option value="3">31%-35%</option>
                    <option value="4">36%-40%</option>
                    <option value="5">41%-45%</option>
                    <option value="6">46%-50%</option>
                    <option value="7">51%-55%</option>
                    <option value="8">56%-60%</option>
                    <option value="9">61%-65%</option>
                    <option value="10">66%-70%</option>
                    <option value="11">71%-75%</option>
                    <option value="12">76%-80%</option>
                    <option value="13">81%-85%</option>
                    <option value="14">86%-90%</option>
                    <option value="15">91%-95%</option>
                    <option value="16">96%-100%</option> -->
                </select>
            </div>
        </div> 
        <div class="content">
            <input type="submit" name="submit" value="Mulai" class="button button-round button-teal">
        </div>
    </form>
</div>
</div>