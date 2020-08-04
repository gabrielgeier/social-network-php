$(document).ready(function () {

    // Default options
    $("#control_1, #control_2, #control_3, #control_4, #control_5, #control_9, #control_12").ultraselect();

    // With callback
    $("#control_6").ultraselect(null, function (el) {
        $("#callbackResult").show().fadeOut();
    });

    // Options displayed in comma-separated list
    $("#control_7").ultraselect({oneOrMoreSelected: '*'});

    // 'Select All' text changed
    $("#control_8").ultraselect({selectAllText: 'Pick &lsquo;em all!'});

    // Selectable option groups
    $("#control_10").ultraselect({selectAll: false, optGroupSelectable: true});

    // Options displayed in comma-separated list only if they fit
    $("#control_11").ultraselect({autoListSelected: true});

    // Test data attributes transfer
    $("#dataTest").append(
        $(".select-class").data("test") + " " +
        $(".optgroup-class").data("test") + " " +
        $(".option-class").data("test")
    );

    // Get/set values with jQuery's .val()
    $("#setValue").click(function() {
        $("#control_12").val(["option_1", "option_2"]);
    });
    $("#getValue").click(function() {
        $("#control_12_result").text("Value: " + JSON.stringify($("#control_12").val()));
    });

    // Init syntax highlighting
    hljs.initHighlightingOnLoad();

    // Show test data
    $("FORM").submit(function () {
        $.post('result.php', $(this).serialize(), function (r) {
            alert(r);
        });
        return false;
    });

});
