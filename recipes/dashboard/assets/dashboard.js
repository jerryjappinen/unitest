
(function (root) {

	var dashboard = function () {
		var self = this;

		// Ko properties
		self.injections = ko.observableArray();
		self.report = ko.observable({});

		self.undoRunnerPath = ko.observable('../');
		self.runnerPath = ko.observable('run/');
		self.runnerStatus = ko.observable(200);

		self.specPath = ko.observable('');
		self.title = ko.observable('Unitest Dashboard');

		// Injections as a hash
		self.injectionsAsHash = ko.computed(function () {
			var hash = {};
			var injections = self.injections();
			for (var i = 0; i < injections.length; i++) {
				hash[injections[i].name] = injections[i].value;
			}
			return hash;
		}).extend({throttle: 1});

		// Data to send to test runner
		self.postData = ko.computed(function () {

			// Prefix relative spec path so runner understands it
			var specPath = self.specPath();
			if (specPath.substr(0, 1) !== '/') {
				specPath = self.undoRunnerPath() + specPath;
			}

			return {
				path: specPath,
				injections: self.injectionsAsHash()
			};
		});



		// Startup
		self.init = function (container) {
			ko.applyBindings(self, container);
			self.load();
			return self;
		};

		// Requests
		self.load = function () {
			var dfd = $.Deferred();

			$.ajax({
				dataType: 'json',
				type: 'POST',
				url: self.runnerPath(),
				data: self.postData(),
				success: function (data, textStatus, jqXHR) {
					self.report(data);
					dfd.resolve();
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(jqXHR.responseText);
					dfd.reject();
				},
				complete: function (jqXHR, textStatus) {
					self.runnerStatus(jqXHR.status);
				}
			});

			return dfd.promise();
		};

		// Run tests when spec path changes
		self.specPath.subscribe(function (newValue) {
			self.load();
		});

	};

	root.dashboard = dashboard;

})(window);