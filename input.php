<?php
session_start();

if ($_SESSION['login_status'] == 'success') : ?>
    <?php
        $pageTitle = "Input Page";
        require_once('pages\header.php');
        require_once('classes\type.php');
        $categoryName = ['Unit(s) Sold', 'Selling Price/Unit', 'Direct Material/Unit', 'Direct Manufacturing Labor/Unit', 'Variable Manufactuing Overhead/Unit', 'Fixed Manufacturing Overhead'];
        $categoryInputName = ['_units_sold', '_selling_price_unit', '_direct_material_unit', '_direct_manufacturing_labor_unit', '_variable_manufacturing_overhead_unit', '_fixed_manufacturing_overhead'];
        ?>
    <script src="scripts\imask.min.js"></script>
    <script src="scripts\input-format.js"></script>
    <script src="scripts\clear-input.js"></script>
    <section class="section">
        <br>
        <div class="columns is-centered">
            <div class="column is-four-fifths">
                <div class=box>
                    <form action="output.php" method="post" id="input">
                        <div class="columns">
                            <div class="column is-4">
                                <h2 class="title has-text-centered">Actual</h2>
                            </div>
                            <div class="column is-4 is-offset-4">
                                <h2 class="title has-text-centered">Budget</h2>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column is-4">
                                <div class="field has-addons">
                                    <p class="control is-expanded">
                                        <input type="text" name="actual<?= $categoryInputName[0] ?>" class="input" placeholder="Actual <?= $categoryName[0] ?>" value="<?php if (!empty($_SESSION['actual' . $categoryInputName[0]])) echo $_SESSION['actual' . $categoryInputName[0]] ?>" required>
                                    </p>
                                    <p class="control">
                                        <a class="button unit">
                                            Unit
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="control is-centered">
                                    <a class="button is-static is-fullwidth">
                                        <?= $categoryName[0] ?>
                                    </a>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field has-addons">
                                    <p class="control is-expanded">
                                        <input type="text" name="budgeted<?= $categoryInputName[0] ?>" class="input" placeholder="Budgeted <?= $categoryName[0] ?>" value="<?php if (!empty($_SESSION['budgeted' . $categoryInputName[0]])) echo $_SESSION['budgeted' . $categoryInputName[0]] ?>" required>
                                    </p>
                                    <p class="control">
                                        <a class="button unit">
                                            Unit
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php for ($i = 1; $i < count($categoryInputName); $i++) : ?>
                            <div class="columns">
                                <div class="column is-4">
                                    <div class="field has-addons">
                                        <p class="control">
                                            <a class="button unit">
                                                <?= $currency ?>
                                            </a>
                                        </p>
                                        <p class="control is-expanded">
                                            <input type="text" name="actual<?= $categoryInputName[$i] ?>" class="input" placeholder="Actual <?= $categoryName[$i] ?>" value="<?php if (!empty($_SESSION['actual' . $categoryInputName[$i]])) echo $_SESSION['actual' . $categoryInputName[$i]] ?>" required>
                                        </p>
                                    </div>
                                </div>
                                <div class="column is-4">
                                    <div class="control is-centered">
                                        <a class="button is-static is-fullwidth">
                                            <?= $categoryName[$i] ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="column is-4">
                                    <div class="field has-addons">
                                        <p class="control">
                                            <a class="button unit">
                                                <?= $currency ?>
                                            </a>
                                        </p>
                                        <p class="control is-expanded">
                                            <input type="text" name="budgeted<?= $categoryInputName[$i] ?>" class="input" placeholder="Budgeted <?= $categoryName[$i] ?>" value="<?php if (!empty($_SESSION['budgeted' . $categoryInputName[$i]])) echo $_SESSION['budgeted' . $categoryInputName[$i]] ?>" required>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                        <div class="field has-text-centered">
                            <div class="columns">
                                <div class="column is-half">
                                    <button type="button" class="button is-danger is-fullwidth" onclick="clearInput()"><i class="fa fa-backspace"></i>&ensp;Clear</button>
                                </div>
                                <div class="column is-half">
                                    <button type="submit" class="button is-primary is-fullwidth"><i class="fa fa-calculator"></i>&ensp; Calculate</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><br>
    </section>
    <?php require_once('pages\footer.php'); ?>
<?php else : ?>
    <?php header('location: login.php'); ?>
<?php endif; ?>