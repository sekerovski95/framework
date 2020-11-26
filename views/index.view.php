<?php require('partials/head.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6">
            <h1>Submit a year!</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 col-md-3 col-lg-3">
            <form method="POST" action="/dates/">
                <div class="form-group">
                    <input name="date" type="date" class="form-control"></input></br>
                    <button id="submit" class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
        <div>
            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>
                            Year
                        </th>
                        <th>
                            Day
                        </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<?php require('partials/footer.php'); ?>
