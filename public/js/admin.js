class Selectize {
	constructor() {
		this.init();
	}

	init() {
		$('.action-box').selectric({
			onChange: (element) => {
				$(element).parents('form').submit();
			}
		});
	}
}

new Selectize();
