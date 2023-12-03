import { MealPlanReader } from "./MealPlanReader";
import { MealPlanWriter } from "./MealPlanWriter";

export class MealPlan {
  constructor() {}

  initialize() {
    this.MealPlanReader = new MealPlanReader();
    this.MealPlanWriter = new MealPlanWriter();
    this.searchByType();
    this.searchByName();
    this.renderRecipeModal();
    //this.updateRecipe();
    this.closeModal();
    this.refreshMealsPage();
    // this.createNewRecipe();
    this.updateFormAction();
    this.addNextInputForRecipe();
  }

  //function that is called on click
  searchByType() {
    $(document).on("click", ".meal-type-button", (event) => {
      var mealType = $(event.target).attr("name");
      console.log(mealType);
      this.MealPlanReader.searchByType(mealType)
        .then((data) => {
          // console.log("Received data:", data);
          $(".main-container").html(data); // Update the content with the received data
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  }

  searchByName() {
    var mainContainer = $(".main-container");
    $(document).on("keydown", ".search-text-box", (event) => {
      if (event.key === "Enter") {
        //mainContainer.empty;
        var mealName = $(event.target).val();
        this.MealPlanReader.searchByName(mealName)
          .then((data) => {
            mainContainer.html(data);
          })
          .catch((error) => {
            console.error("Error: ", error);
          });
      }
    });
  }

  refreshMealsPage() {
    var mainContainer = $(".main-container");
    $(document).on("click", ".refresh-arrow", (event) => {
      $(".meals-container").html.empty;
      this.MealPlanReader.refreshMealsPage()
        .then((data) => {
          mainContainer.html(data);
        })
        .catch((error) => {
          console.log(error);
        });
    });
  }

  showRecipe(mealID) {
    $(".recipe-container").empty();
    $(".recipe-modal").modal("hide");
    this.MealPlanReader.showRecipe(mealID)
      //.then((response) => response.json())
      .then((data) => {
        $(".recipe-container").append(data);
        $(".recipe-modal").modal("show");
        $(".recipe-container").css("display", "block");
        //the below is only for if it's a new recipe. We may want to combine the routes for this one.
        this.updateFormAction(mealID);
      })
      .catch((error) => {
        console.log(error);
      });
  }

  renderRecipeModal() {
    const mealName = $(".meal-name-text");
    mealName.on("click", (event) => {
      var mealID = $(event.currentTarget)
        .closest(".meal-container")
        .find(".meal-id")
        .val();

      this.showRecipe(mealID);
    });
  }

  updateFormAction(mealID) {
    let formAction = "/meal/" + mealID + "/new-recipe";
    $("#add-new-recipe-form-id").attr("action", formAction);
  }

  addNextInputForRecipe() {
    $(".add-next-step-btn").on("click", (e) => {
      e.preventDefault();
      console.log("here");
      let newRecipeStepID = $("<input>").attr({
        type: "number",
        class: "recipe-step-id",
      });

      let newInputRecipeStep = $("<input>").attr({
        type: "text",
        class: "form-control recipe-step",
      });

      $(".recipe-steps-container").append(newRecipeStepID, newInputRecipeStep);
    });
  }

  // updateRecipe() {
  //   $(document).on("click", ".save-recipe", (event) => {
  //     var recipeDataToSave = [];
  //     var mealID = $(".meal-id").val();
  //     $(".recipe-step").each(function () {
  //       var recipeStep = $(this).val();
  //       var recipeStepId = $(this).next(".recipeStepID").val();
  //       recipeDataToSave.push({
  //         recipeStepId: recipeStepId,
  //         recipeStepDesc: recipeStep,
  //       });
  //     });
  //     var jsonRecipeData = JSON.stringify(recipeDataToSave);
  //     this.MealPlanWriter.saveRecipe(jsonRecipeData, mealID)
  //       .then((data) => {
  //         console.log("success");
  //       })
  //       .catch((error) => {
  //         console.log(error);
  //       });
  //   });
  // }

  closeModal() {
    $("#close-recipe-modal").on("click", function (event) {
      $(".modal").modal("hide");
    });
  }
}
