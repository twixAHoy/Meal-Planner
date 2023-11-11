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

  //currently not working
  // async createNewRecipe(data, mealID) {
  //   // console.log(data);
  //   //var form = new FormData(data[0]);
  //   //console.log(form);
  //   $.post({
  //     url: "/meal/" + mealID + "/new-recipe",
  //     cache: false,
  //     method: "POST",
  //     data: {
  //       data: data,
  //       mealID: mealID,
  //     },

  //     //contentType: "application/x-www-form-urlencoded; charset=UTF-8",
  //     //contentType: "application/json",
  //     success: function (data) {},
  //     error: function (xhr, status, error) {
  //       console.log("failed");
  //       console.log(error, xhr);
  //     },
  //   });
  // }
}
