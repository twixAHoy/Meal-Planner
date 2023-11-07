export class MealPlanWriter {
  async saveRecipe(updatedRecipeSteps, mealID) {
    console.log(updatedRecipeSteps);
    console.log(typeof updatedRecipeSteps);
    await $.ajax({
      url: "/recipe/meal/update/" + mealID,
      cache: false,
      type: "POST",
      data: { recipeSteps: updatedRecipeSteps, mealID: mealID },
      contentType: "application/json",
      success: function (data) {
        // console.log(data);
      },
      error: function (xhr, status, error) {
        console.log("failed");
        console.log(error, xhr);
      },
    });
  }

  async createNewRecipe(newRecipeSteps, mealID) {
    console.log(typeof newRecipeSteps);
    console.log(newRecipeSteps);
    await $.ajax({
      url: "/meal/" + mealID + "/new-recipe",
      cache: false,
      method: "POST",
      data: {
        recipeSteps: newRecipeSteps,
        mealID: mealID,
      },
      contentType: "application/json",
      success: function (data) {},
      error: function (xhr, status, error) {
        console.log("failed");
        console.log(error, xhr);
      },
    });
  }
}
