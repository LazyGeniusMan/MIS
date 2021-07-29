<?php
session_start();

if ($_SESSION['login_status'] == 'success') : ?>
    <?php
        $pageTitle = "Output Page";
        require_once('pages\header.php');
        require_once('classes\type.php');
        require_once('classes\variance.php');
        $categoryInputName = ['_units_sold', '_selling_price_unit', '_direct_material_unit', '_direct_manufacturing_labor_unit', '_variable_manufacturing_overhead_unit', '_fixed_manufacturing_overhead'];
        foreach ($_POST as $key => $value) {
            $_POST[$key] = preg_replace("/[^0-9.]/", "", $value);
          }
        for ($i=0; $i < count($categoryInputName) ; $i++) { 
            $_SESSION['actual'.$categoryInputName[$i]] = $_POST['actual'.$categoryInputName[$i]];
            $_SESSION['budgeted'.$categoryInputName[$i]] = $_POST['budgeted'.$categoryInputName[$i]];
        }
        $actual = new Type("actual");
        $budgeted = new Type("budgeted");
        $flexible = new SpecialType("flexible");
        $flexibleBudgetVariance = new Variance("flexible-budget", $actual, $flexible);
        $salesVolumeVariance = new Variance("sales-volume", $budgeted, $flexible);
        $outputName = ["Unit(s) Sold", "Revenue", "Variable Cost", "&ensp;Direct Material", "&ensp;Direct Manufacturing Labor", "&ensp;Variable Manufacturing Overhead", "&ensp;&ensp;Total Variable Cost", "Contribution Margin", "Fixed Manufacturing Cost", "Operating Income"];
        ?>
    <section class="section">
        <br>
        <div class="columns is-centered">
            <div class="column is-four-fifths">
                <div class=box>
                    <table class="table table is-striped table is-fullwidth">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    <p class="has-text-centered">Actual Result</p>
                                </th>
                                <th colspan="2">
                                    <p class="has-text-centered">Flexible-Budget<br>Variance</p>
                                </th>
                                <th>
                                    <p class="has-text-centered">Flexible Budget<p>
                                </th>
                                <th colspan="2">
                                    <p class="has-text-centered">Sales-Volume<br>Variance</p>
                                </th>
                                <th>
                                    <p class="has-text-centered">Static Budget</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($actual->output); $i++) : ?>
                                <tr>
                                    <th>
                                        <p><?= $outputName[$i] ?></p>
                                    </th>
                                    <td>
                                        <p class="is-pulled-<?= ($i == 0 ? "right" : "left") ?>"><?= ($i == 0 ? "&ensp; Unit" : ($i == 2 ? "" : $currency)) ?></p>
                                        <p class="is-pulled-right"><?= ($i == 0 ? number_format($actual->output[$i]) : ($i == 2 ? $actual->output[$i] : number_format($actual->output[$i], 2))) ?></p>
                                    </td>
                                    <td>
                                        <p class="is-pulled-<?= ($i == 0 ? "right" : "left") ?>"><?= ($i == 0 ? "&ensp; Unit" : ($i == 2 ? "" : $currency)) ?></p>
                                        <p class="is-pulled-right"><?= ($i == 0 ? number_format($flexibleBudgetVariance->output[$i]) : ($i == 2 ? $flexibleBudgetVariance->output[$i] : number_format($flexibleBudgetVariance->output[$i], 2))) ?></p>
                                    </td>
                                    <td>
                                        <b>
                                            <p class="has-text-centered"><abbr title="<?= ($flexibleBudgetVariance->condition[$i] == 'F' ? 'Favorable' : ($flexibleBudgetVariance->condition[$i] == 'U' ? "Unfavorable" : '')) ?>"><?= (($i == 2 OR $flexibleBudgetVariance->condition[$i] == '') ? "" : '[' . $flexibleBudgetVariance->condition[$i] . ']') ?></abbr></p>
                                        </b>
                                    </td>
                                    <td>
                                        <p class="is-pulled-<?= ($i == 0 ? "right" : "left") ?>"><?= ($i == 0 ? "&ensp; Unit" : ($i == 2 ? "" : $currency)) ?></p>
                                        <p class="is-pulled-right"><?= ($i == 0 ? number_format($flexible->output[$i]) : ($i == 2 ? $flexible->output[$i] : number_format($flexible->output[$i], 2))) ?></p>
                                    </td>
                                    <td>
                                        <p class="is-pulled-<?= ($i == 0 ? "right" : "left") ?>"><?= ($i == 0 ? "&ensp; Unit" : ($i == 2 ? "" : $currency)) ?></p>
                                        <p class="is-pulled-right"><?= ($i == 0 ? number_format($salesVolumeVariance->output[$i]) : ($i == 2 ? $salesVolumeVariance->output[$i] : number_format($salesVolumeVariance->output[$i], 2))) ?></p>
                                    </td>
                                    <td>
                                        <b>
                                            <p class="has-text-centered"><abbr title="<?= ($salesVolumeVariance->condition[$i] == 'F' ? 'Favorable' : ($salesVolumeVariance->condition[$i] == 'U' ? "Unfavorable" : '')) ?>"><?= (($i == 2 OR $salesVolumeVariance->condition[$i] == '') ? "" : '[' . $salesVolumeVariance->condition[$i] . ']') ?></abbr></p>
                                        </b>
                                    </td>
                                    <td>
                                        <p class="is-pulled-<?= ($i == 0 ? "right" : "left") ?>"><?= ($i == 0 ? "&ensp; Unit" : ($i == 2 ? "" : $currency)) ?></p>
                                        <p class="is-pulled-right"><?= ($i == 0 ? number_format($budgeted->output[$i]) : ($i == 2 ? $budgeted->output[$i] : number_format($budgeted->output[$i], 2))) ?></p>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    <a href="input.php" class="button is-info is-fullwidth has-text-white"><i class="fa fa-edit"></i>&ensp;Edit</a>
                </div>
            </div>
        </div>
        <br>
    </section>
    <?php require_once('pages\footer.php'); ?>
<?php else : ?>
    <?php header('location: login.php'); ?>
<?php endif; ?>