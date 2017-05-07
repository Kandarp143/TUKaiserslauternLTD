<style>
    th, td {
        padding: 4px;
    }
</style>
<div class="entry">
    <table>
        <?php
        echo "<tr style='text-align: left'><th>Substance</th><td>" . toSubstanceTitle($substance) . "</td></tr>";
        echo "<tr style='text-align: left'><th>CAS-No</th><td>" . $casno . "</td></tr>";
        echo "<tr style='text-align: left'><th>Reference</th><td>[" . $ref . "]</td></tr>";
        echo "<tr style='text-align: left'><th>Model Type</th><td>" . $modeltype . "</td></tr>";
        echo "<tr style='text-align: left'><th>Type</th><td>" . $type . "</td></tr>";
        echo "<tr style='text-align: left'><th>Description</th><td>" . $description . "</td></tr>";

        ?>
    </table>
</div>