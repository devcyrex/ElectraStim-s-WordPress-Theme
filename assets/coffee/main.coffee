@Module = do ->

	init = () ->

		alert "hello"

		Events.init()
		Homepage.init()
		Moblie.init()
		LoginPage.init()
		SidebarWidgets.init()

		Utill.getMoblie()
		

		Events.addOnloadedEvent Utill.getMoblie
		Events.addOnloadedEvent Moblie.checkBackground

		Events.addOnloadedEventToPage "http://www.electrastim.com/testsite/", Homepage.resized
		Events.addOnloadedEventToPage "http://www.electrastim.com/testsite/", Homepage.desktopBanner
		Events.addOnloadedEventToPage "http://www.electrastim.com/testsite/", Homepage.mobileBanner
		Events.addOnloadedEventToPage "http://www.electrastim.com/testsite/", Homepage.bannerQuickLinkPadding

		# login password checker
		Events.addPageEvent "http://www.electrastim.com/testsite/login-2/", LoginPage.passwordChecker
		
		Events.addResizeEvent Moblie.checkBackground

		# homepage events
		Events.addResizeEventToPage "http://www.electrastim.com/testsite/", Homepage.resized
		Events.addResizeEventToPage "http://www.electrastim.com/testsite/", Homepage.mobileBanner
		Events.addResizeEventToPage "http://www.electrastim.com/testsite/", Homepage.desktopBanner
		Events.addResizeEventToPage "http://www.electrastim.com/testsite/", Homepage.bannerQuickLinkPadding

		# moblie evetns
		Events.addResizeEvent Moblie.checkBackground

		Events.addResizeEvent Utill.getMoblie

		# Events.addMoblieEventToPage "http://www.electrastim.com/testsite/shop/", SidebarWidgets.moblieRefillButton
		# Events.addMoblieEventToPage "http://www.electrastim.com/testsite/product-category/anal-sex-toys/", SidebarWidgets.moblieRefillButton
		# Events.addMoblieEventToPage "http://www.electrastim.com/testsite/product-category/bundles/", SidebarWidgets.moblieRefillButton
		# Events.addMoblieEventToPage "http://www.electrastim.com/testsite/product-category/cables-adapters/", SidebarWidgets.moblieRefillButton
		# Events.addMoblieEventToPage "http://www.electrastim.com/testsite/product-category/cock-rings-toys/", SidebarWidgets.moblieRefillButton
		# Events.addMoblieEventToPage "http://www.electrastim.com/testsite/product-category/dildos-probes/", SidebarWidgets.moblieRefillButton
		# Events.addMoblieEventToPage "http://www.electrastim.com/testsite/product-category/electrastim-stimulators/", SidebarWidgets.moblieRefillButton
		# Events.addMoblieEventToPage "http://www.electrastim.com/testsite/product-category/fetish-accessories/", SidebarWidgets.moblieRefillButton
		# Events.addMoblieEventToPage "http://www.electrastim.com/testsite/product-category/lubes-pads/", SidebarWidgets.moblieRefillButton

		Events.run()

	init: init

Module.init()