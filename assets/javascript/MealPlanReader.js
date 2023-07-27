export class MealPlanReader {
  searchByType(mealType) {
    return new Promise((resolve, reject) => {
      $.get({
        url: "/all-meals/type/" + mealType,
        cache: false,
        type: "GET",
        //contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: { mealType: mealType },
        success: function (data) {
          console.log(data);
          resolve(data);
          //$(".main-container").html(response);
        },
        error: function (xhr, status, error) {
          console.log(error, xhr);
          reject(xhr);
        },
      });
    });
  }
}
