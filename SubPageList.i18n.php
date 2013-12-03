<?php

/**
 * Internationalization file for the SubPageList extension.
 *
 * @file
 * @ingroup SPL
 *
 * @licence GNU GPL v2+
 *
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

$messages = array();

/** English
 * @author Jeroen De Dauw
 */
$messages['en'] = array(
	'spl-desc' => 'Allows to list and count subpages',

	'spl-nosubpages' => 'Page "$1" has no subpages to list.',
	'spl-noparentpage' => 'Page "$1" does not exist.',
	'spl-nopages' => 'Namespace "$1" does not have pages.',

	'spl-subpages-par-sort' => 'The direction to sort in. Allowed values: "asc" and "desc".',
	'spl-subpages-par-sortby' => 'What to sort the subpages by. Allowed values: "title" or "lastedit".',
	'spl-subpages-par-format' => 'The subpage list can be displayed in several formats. Allowed values: "ol" — ordered (numbered) list, "ul" — unordered (bulleted) lists, "list" — plain lists (for example comma-separated list).',
	'spl-subpages-par-page' => 'The page to show the subpages for, or namespace name (including trailing colon) to show pages in. Defaults to the current page.',
	'spl-subpages-par-showpage' => 'Indicates if the page itself should be shown in the list or not.',
	'spl-subpages-par-pathstyle' => 'The style of the path for subpages in the list. Allowed values: "fullpagename" — full page name (including namespace), "pagename" — page name (without namespace), "subpagename" — relative page name starting from the page we list subpages for, "none" — just the trailing part of the name after last slash.',
	'spl-subpages-par-kidsonly' => 'Allows showing only direct subpages.',
	'spl-subpages-par-limit' => 'The maximum number of pages to list.',
	'spl-subpages-par-element' => 'The HTML element enclosing the list (including "intro" and "outro" or "default" texts). Allowed values: "div", "p", "span".',
	'spl-subpages-par-class' => 'The value for "class" attribute of the HTML element enclosing the list.',
	'spl-subpages-par-intro' => 'The text to output before the list, if the list is not empty.',
	'spl-subpages-par-outro' => 'The text to output after the list, if the list is not empty.',
	'spl-subpages-par-default' => 'The text to output instead of the list, if the list is empty. If empty, error message will rendered (such as "Page has no subpages to list"). If dash ("-"), result will be completely empty.',
	'spl-subpages-par-separator' => 'The text to output between two list items in case of "list" (and its alias "bar") format. Has no effect in other formats.',
	'spl-subpages-par-template' => 'The name of template. The template is applied to every item of the list. An item is passed as the first (unnamed) argument. Note that template does not cancel list formatting. Formatting ("ul", "ol", "list") is applied to the template\'s result.',
	'spl-subpages-par-links' => 'If true, list items are rendered as links. If false, list items are rendered as plain text. The latter is especially helpful for passing items into templates for further processing.',
);

/** Message documentation (Message documentation)
 * @author Hamilton Abreu
 * @author Purodha
 * @author Shirayuki
 * @author 아라
 */
$messages['qqq'] = array(
	'spl-desc' => '{{desc|name=Sub Page List|url=http://www.mediawiki.org/wiki/Extension:SubPageList}}',
	'spl-nosubpages' => 'Parameters:
* $1 - page title (with link)
See also:
* {{msg-mw|Spl-noparentpage}}
* {{msg-mw|Spl-nopages}}',
	'spl-noparentpage' => 'Parameters:
* $1 - page title
See also:
* {{msg-mw|Spl-nosubpages}}
* {{msg-mw|Spl-nopages}}',
	'spl-nopages' => 'Parameters:
* $1 - namespace name
See also:
* {{msg-mw|Spl-noparentpage}}
* {{msg-mw|Spl-nosubpages}}',
	'spl-subpages-par-sort' => '{{doc-important|Do not translate "asc" and "desc".}}',
	'spl-subpages-par-sortby' => '{{doc-important|Do not translate "title" and "lastedit".}}',
	'spl-subpages-par-format' => '{{doc-important|Do not translate "ol", "ul" and "list".}}',
	'spl-subpages-par-pathstyle' => '{{doc-important|The parameters "fullpagename", "pagename", "subpagename" and "none" should not be translated!}}',
	'spl-subpages-par-kidsonly' => 'Used as description for a boolean parameter.',
	'spl-subpages-par-element' => '{{doc-important|Do not translate "intro", "outro", "default", "div", "p", and "span".}}',
	'spl-subpages-par-class' => '{{doc-important|Do not translate "class".}}',
	'spl-subpages-par-intro' => 'See also:
* {{msg-mw|Spl-subpages-par-outro}}',
	'spl-subpages-par-outro' => 'See also:
* {{msg-mw|Spl-subpages-par-intro}}',
	'spl-subpages-par-separator' => '{{doc-important|Do not translate "list" and "bar".}}',
	'spl-subpages-par-template' => '{{doc-important|Do not translate "ul", "ol", and "list".}}',
);

/** Asturian (asturianu)
 * @author Xuacu
 */
$messages['ast'] = array(
	'spl-desc' => 'Amiesta una etiqueta <code><nowiki><splist /></nowiki></code> que permite facer una llista de subpáxines',
	'spl-nosubpages' => "La páxina «$1» nun tien páxines secundaries qu'amosar.",
	'spl-noparentpage' => 'La páxina «$1» nun esiste.',
	'spl-nopages' => "L'espaciu de nomes «$1» nun tien páxines.",
	'spl-subpages-par-sort' => 'La direición d\'ordenación. Valores permitíos: "asc" y "desc".',
	'spl-subpages-par-sortby' => 'Criteriu pa ordenar les subpáxines. Valores permitíos: "title" o "lastedit".',
	'spl-subpages-par-format' => 'La llista de subpáxines pue amosase\'n dellos formatos. Valores permitíos: "ol" — llista ordenada (numberada), "ul" — llistes desordenaes (con viñetes), "list" — llistes simples (por exemplu llista separada por comas).',
	'spl-subpages-par-page' => "La páxina de la qu'amosar les subpáxines o'l nome del espaciu de nomes (incluyendo los dos puntos finales) del qu'amosar les páxines. La predeterminada ye la páxina actual.",
	'spl-subpages-par-showpage' => "Indica si la propia páxina tien d'apaecer na llista o non.",
	'spl-subpages-par-pathstyle' => 'L\'estilu del camín de les subpáxines de la llista. Valores permitíos: "fullpagename": nome completu de la páxina (incluyendo espaciu de nomes), "pagename" — nome de la páxina (ensin espaciu de nomes), "subpagename" — nome relativu de la páxina comenzando dende la páxina pa la que vamos a facer la llista de subpáxines, "none" — sólo la parte final del nome dempués de la última barra.',
	'spl-subpages-par-kidsonly' => 'Permite ver sólo les subpáxines direutes.',
	'spl-subpages-par-limit' => 'El númberu máximu de páxines a poner na llista.',
	'spl-subpages-par-element' => 'L\'elementu HTML que rodea la llista (incluyendo los testos "intro" y "outro" o "default"). Valores permitíos: "div", "p", "span".',
	'spl-subpages-par-class' => 'El valor pal atributu "class" del elementu HTML que rodea la llista.',
	'spl-subpages-par-intro' => 'El testu a poner antes de la llista, si la llista nun ta balera.',
	'spl-subpages-par-outro' => 'El testu a poner dempués de la llista, si la llista nun ta balera.',
	'spl-subpages-par-default' => 'El testu a poner en llugar de la llista, si la llista ta balera. Si ta balera, apaecerá esti mensaxe d\'error (como "La páxina nun tien nenguna subpáxina que poner na llista"). Si ye un guión ("-"), el resultáu tará en blanco dafechu.',
	'spl-subpages-par-separator' => 'El testu a amosar ente dos elementos de la llista nel casu del formatu "list" (ya\'l so alcuñu "bar"). Nun tien efeutu colos demás formatos.',
	'spl-subpages-par-template' => 'El nome de la plantía. La plantía aplicase a cada elementu de la llista. Un elementu pasase como primer argumentu (ensin nome). Tenga en cuenta que la plantía nun anula\'l formatu de la llista. El formatu ("ul", "ol", "list") aplicase al resultáu de la plantía.',
	'spl-subpages-par-links' => 'Si ye verdadero, los elementos de la llista veránse como enllaces. Si ye falso, los elementos de la llista veránse como testu planu. Lo último ye especialmente útil para pasar los elementos a les plantíes pa procesalos posteriormente.',
);

/** Belarusian (Taraškievica orthography) (беларуская (тарашкевіца)‎)
 * @author EugeneZelenko
 * @author Jim-by
 * @author Renessaince
 * @author Wizardist
 */
$messages['be-tarask'] = array(
	'spl-desc' => 'Дадае тэг <code><nowiki><splist /></nowiki></code>, які выводзіць сьпіс падстаронак',
	'spl-nosubpages' => 'Старонка «$1» ня мае падстаронак для сьпісу.',
	'spl-noparentpage' => 'Старонка «$1» не існуе.',
	'spl-nopages' => 'Прастора назваў «$1» ня ўтрымлівае старонак.',
	'spl-subpages-par-sort' => 'Напрамак сартаваньня. Дапушчальныя значэньні: "asc" і "desc".',
	'spl-subpages-par-sortby' => 'Ключ сартаваньня падстаронак. Дапушчальныя значэньні: "title" ці "lastedit".',
	'spl-subpages-par-format' => 'Сьпіс падстаронак можа быць паказаны ў некалькіх фарматах. Дапушчальныя значэньні: "ol" — нумараваныя сьпісы, "ul" — маркіраваныя сьпісы і "list" — простыя сьпісы (напрыклад, падзеленыя коскамі).',
	'spl-subpages-par-page' => "Старонка, для якой паказваць сьпіс падстаронак, альбо прастора назваў (улучна з заключным двухкроп'ем), у якой паказваць старонкі. Па змоўчваньні цяперашняя старонка.",
	'spl-subpages-par-showpage' => 'Паказвае, ці павінна паказвацца старонка ў сьпісе.',
	'spl-subpages-par-pathstyle' => 'Стыль шляху для падстаронак у сьпісе. Дапушчальныя значэньні: "fullpagename" — поўная назва старонкі (разам з прасторай назваў); "pagename" — назва старонкі (без прасторы назваў); "subpagename" — адносная назва старонкі, пачынаючы са старонкі, для якой пералічваюцца падстаронкі; "none" — толькі заключная частка назвы пасьля апошняй нахільнай рыскі.',
	'spl-subpages-par-kidsonly' => 'Паказваць толькі прамыя падстаронкі.',
	'spl-subpages-par-limit' => 'Максымальная колькасьць старонак для паказу.',
	'spl-subpages-par-element' => 'Элемэнт HTML, які агортвае сьпіс (разам з тэкстамі "intro" і "outro" або "default"). Дапушчальныя значэньні: "div", "p", "span".',
	'spl-subpages-par-class' => 'Значэньне атрыбуту «class» агортваючага сьпіс элемэнту HTML.',
	'spl-subpages-par-intro' => 'Тэкст для вываду перад сьпісам, калі той не пусты.',
	'spl-subpages-par-outro' => 'Тэкст для вываду пасьля сьпісу, калі той не пусты.',
	'spl-subpages-par-default' => 'Тэкст для вываду замест сьпісу, калі той пусты. Калі не зададзены, будзе згенэраванае паведамленьне пра памылку (кшталту «Старонка ня мае падстаронак для сьпісу»). Калі ж зададзены злучок («-»), выводзіцца пустое значэньне.',
	'spl-subpages-par-separator' => 'Тэкст для вываду паміж двума элемэнтамі сьпісу ў фарматах «list» і «bar». Для іншых фарматаў ня мае эфэкту.',
	'spl-subpages-par-template' => 'Назва шаблёну. Шаблён ужываецца для кожнага элемэнту сьпісу. Элемэнт перадаецца як першы (безназоўны) аргумэнт. Заўважце, што шаблён не скасоўвае фарматаваньне сьпісу. Фарматаваньне («ul», «ol», «list») ўжываецца да вынікаў шаблёну.',
	'spl-subpages-par-links' => 'Калі сапраўдна, элемэнты сьпісу выводзяцца як спасылкі. Калі несапраўдна, выводзяцца як звычайны тэкст. Апошняе асабліва зручна для перадачы элемэнтаў у шаблёны для далейшай апрацоўкі.',
);

/** Breton (brezhoneg)
 * @author Fulup
 * @author Y-M D
 */
$messages['br'] = array(
	'spl-desc' => 'Ouzhpennañ a ra ur valizenn  <code><nowiki><splist /></nowiki></code> a dalvez da rollañ an ispajennoù',
	'spl-nosubpages' => 'N\'eus ispajenn ebet da rollañ evit ar bajenn "$1".',
	'spl-subpages-par-sort' => 'Tu an urzhiañ. Tu zo da lakaat an talvoudennoù : "krsk" ha "digrsk".',
	'spl-subpages-par-sortby' => 'Penaos urzhiañ an ispajennoù dre. Talvoudennoù aotreet : "title\' pe "lastedit".',
	'spl-subpages-par-format' => 'Gallout a ra ar roll ispajennoù bezañ diskwelet dre furmadoù disheñvel : rolloù niverennet (ol), rolloù padennek (ul) pe rolloù dispartiet dre skejoù (roll).', # Fuzzy
	'spl-subpages-par-page' => 'Ar bajenn da welet an ispajennoù. Ar bajenn red eo an hini dre ziouer.', # Fuzzy
	'spl-subpages-par-showpage' => 'Merkañ a ra ha rankout a ra ar bajenn bezañ war ar roll pe get.',
	'spl-subpages-par-pathstyle' => 'Stil hent ispajennoù ar roll.', # Fuzzy
	'spl-subpages-par-kidsonly' => 'Aotren a ra diskouez hepken an ispajennoù eeun',
	'spl-subpages-par-limit' => 'Niver brasañ a bajennoù da rollañ.',
);

/** Bosnian (bosanski)
 * @author CERminator
 */
$messages['bs'] = array(
	'spl-desc' => 'Dodaje <code><nowiki><splist /></nowiki></code> oznaku koja vam omogućuje da pregledate podstranice',
	'spl-nosubpages' => '$1 nema podstranica za prikaz.', # Fuzzy
	'spl-subpages-par-sort' => 'Smijer za redanje.', # Fuzzy
);

/** Czech (česky)
 * @author Reaperman
 */
$messages['cs'] = array(
	'spl-desc' => 'Přidává značku <code><nowiki><splist /></nowiki></code>, která umožňuje zobrazit seznam podstránek',
	'spl-nosubpages' => 'Stránka „$1“ nemá žádné zobrazitelné podstránky.',
	'spl-noparentpage' => 'Stránka „$1“ neexistuje.',
	'spl-nopages' => 'Jmenný prostor „$1“ neobsahuje žádné stránky.',
	'spl-subpages-par-limit' => 'Maximální počet zobrazovaných stránek.',
);

/** German (Deutsch)
 * @author Kghbln
 * @author Metalhead64
 * @author Purodha
 */
$messages['de'] = array(
	'spl-desc' => 'Ermöglicht das Auflisten und Zählen von Unterseiten',
	'spl-nosubpages' => 'Seite „$1“ verfügt über keine auflistbaren Unterseiten.',
	'spl-noparentpage' => 'Seite „$1“ ist nicht vorhanden.',
	'spl-nopages' => 'Im Namensraum „$1“ befinden sich keine Seiten.',
	'spl-subpages-par-sort' => 'Sortierreihenfolge für die Unterseiten. Mögliche Werte: „asc“ (aufsteigend) und „desc“ (absteigend)',
	'spl-subpages-par-sortby' => 'Sortierkriterium für die Unterseiten. Mögliche Werte: „titel“ (Titel) und „lastedit“ (letzte Bearbeitung)',
	'spl-subpages-par-format' => 'Die Liste der Unterseiten kann in verschiedenen Formaten angezeigt werden. Mögliche Werte: „ol“ (sortierte nummerierte Liste), „ul“ (unsortierte Aufzählung) oder „list“ (einfache Liste, bspw. eine kommagetrennte Liste).',
	'spl-subpages-par-page' => 'Die Seite für welche die Unterseiten oder der Namensraum (einschließlich eines anschließenden Doppelpunkts) für den die enthaltenen Seiten angezeigt werden sollen. Standardmäßig ist dies die aktuelle Seite.',
	'spl-subpages-par-showpage' => 'Gibt an, ob die Seite selbst in der Liste ihrer Unterseiten angezeigt werden soll oder nicht.',
	'spl-subpages-par-pathstyle' => 'Anzeigestil für die Pfade in der Liste angezeigten Unterseiten. Mögliche Werte: „fullpagename“ (Seitenname einschließlich des Namensraums),  „pagename“ (Seitenname ausschließlich des Namensraums),  „subpagename“ (Seitenname der Unterseiten der aktuellen Seite) und „none“ (lediglich der auf den letzten Schrägstrich folgende Teil des Seitennamens).',
	'spl-subpages-par-kidsonly' => 'Ermöglicht ausschließlich die Anzeige der direkten Unterseiten.',
	'spl-subpages-par-limit' => 'Die Höchstzahl der aufzulistenden Unterseiten.',
	'spl-subpages-par-element' => 'Das HTML-Element, das die Liste umschließen soll (einschließlich der Texte „intro“, „outro“ oder „standard“). Mögliche Werte: „div“, „p“, „span“.',
	'spl-subpages-par-class' => 'Der Wert für das Attribut „class“ des HTML-Elements, das die Liste umschließt.',
	'spl-subpages-par-intro' => 'Der vor der Liste auszugebende Text („intro“), sofern sie nicht leer ist.',
	'spl-subpages-par-outro' => 'Der nach der Liste auszugebende Text („outro“), sofern sie nicht leer ist.',
	'spl-subpages-par-default' => 'Der anstatt einer Liste auszugebende Text („standard“), sofern sie leer ist. Sofern sie leer ist, wird also eine Fehlermeldung, wie bspw. „Zu dieser Seite gibt es keine Unterseiten.“ ausgegeben. Wenn ein Bindestrich („-“) angegeben wird, wird die Ergebnisausgabe vollkommen leer sein.',
	'spl-subpages-par-separator' => 'Der zwischen den Listenelementen auszugebende Text, sofern die Anzeigeformate „list“ oder „bar“ genutzt wird. Er wird nicht bei anderen Formaten ausgegeben.',
	'spl-subpages-par-template' => 'Der Name der Vorlage. Die Vorlage wird auf jedes Listenelement angewendet. Ein Listenelement wird als erstes (unbezeichnetes) Argument an die Vorlage übergeben. Es ist zu beachten, dass die Vorlage nicht die Listenformatierung verändert. Die Formatierungsmöglichkeiten „ul“, „ol“ und „list“ werden also auf das in der Vorlage ausgegebene Ergebnis angewendet.',
	'spl-subpages-par-links' => 'Sofern aktiviert werden die Listenelemente als Links dargestellt. Sofern deaktiviert, werden die Listenelement im Textformat ausgegeben. Letztere Einstellung ist besonders dann hilfreich, wenn man die Ausgabeergebnisse an die Vorlage zur weiteren Verarbeitung weitergibt.',
);

/** Spanish (español)
 * @author Armando-Martin
 */
$messages['es'] = array(
	'spl-desc' => 'Añade una etiqueta <code><nowiki><splist /></nowiki></code> que le permite enumerar las subpáginas',
	'spl-nosubpages' => 'La página "$1" no tiene ninguna subpágina en la lista.',
	'spl-noparentpage' => 'La página "$1" no existe.',
	'spl-nopages' => 'El espacio de nombres "$1" no tiene páginas.',
	'spl-subpages-par-sort' => 'La dirección para la ordenación. Valores permitidos: "asc" y "desc".',
	'spl-subpages-par-sortby' => 'Criterio de ordenación de las subpáginas. Valores permitidos: "title" o "lastedit"',
	'spl-subpages-par-format' => 'La lista de subpáginas puede mostrarse en varios formatos. Valores permitidos: "ol" — lista ordenada (numerada), "ul" — listas desordenadas (con viñetas), "list" — listas simples (por ejemplo lista separada por comas).',
	'spl-subpages-par-page' => 'La página en la que mostrar las subpáginas o el espacio de nombres (incluídos los dos puntos) en el que mostrar las páginas. La página actual es la predeterminada.',
	'spl-subpages-par-showpage' => 'Indica si la propia página debe mostrarse en la lista o no.',
	'spl-subpages-par-pathstyle' => 'El estilo de la ruta de acceso a las subpáginas en la lista. Valores permitidos: "fullpagename": nombre de página completo (incluido el espacio de nombres), "pagename" — nombre de la página (sin espacio de nombres), "subpagename" — nombre relativo de la página comenzando desde la página de la que vamos a citar sus subpáginas, "none" — sólo la parte final del nombre después de la última barra.',
	'spl-subpages-par-kidsonly' => 'Permite mostrar sólo las subpáginas directas.',
	'spl-subpages-par-limit' => 'El número máximo de páginas para enumerar.',
	'spl-subpages-par-element' => 'El elemento HTML que engloba la lista (incluidos los textos "Intro" y "outro" o "default"). Valores permitidos: "div", "p", "span".',
	'spl-subpages-par-class' => 'El valor del atributo "class" del elemento HTML que engloba la lista.',
	'spl-subpages-par-intro' => 'El texto a mostrar antes de la lista, si la lista no está vacía.',
	'spl-subpages-par-outro' => 'El texto a mostrar después de la lista, si la lista no está vacía.',
	'spl-subpages-par-default' => 'El texto a mostrar en lugar de la lista, si la lista está vacía. Si está vacía, se procesará un mensaje de error (como "La página no tiene ninguna subpágina que enumerar"). Si el valor fuese un guión ("-"), el resultado estará completamente vacío.',
	'spl-subpages-par-separator' => 'El texto a mostrar entre dos elementos de la lista en caso de que el formato fuese "list" (y su alias "bar"). No tiene ningún efecto en los otros formatos de lista.',
	'spl-subpages-par-template' => 'El nombre de la plantilla. La plantilla se aplica a cada elemento de la lista. Un elemento es tratatdo como primer argumento (sin nombre). Tenga en cuenta que la plantilla no anula el formato de lista. El formato ("ul", "ol", "list") se aplica al resultado de la plantilla.',
	'spl-subpages-par-links' => 'Si el valor fuese verdadero (true), los elementos de la lista se representan como enlaces. Si es falso (false), los elementos de la lista se procesan como texto sin formato. Este último caso es especialmente útil para pasar elementos a las plantillas para su posterior procesamiento.',
);

/** Finnish (suomi)
 * @author Nedergard
 * @author Nike
 */
$messages['fi'] = array(
	'spl-noparentpage' => 'Sivua ”$1” ei ole.',
	'spl-nopages' => 'Nimiavaruudessa $1 ei ole sivuja.',
);

/** French (français)
 * @author Gomoko
 * @author Hashar
 * @author Seb35
 * @author Sherbrooke
 * @author Toliño
 */
$messages['fr'] = array(
	'spl-desc' => 'Permet de lister et compter les sous-pages',
	'spl-nosubpages' => 'La page « $1 » n’a pas de sous-pages à lister.',
	'spl-noparentpage' => 'La page « $1 » n’existe pas.',
	'spl-nopages' => 'L’espace de nom « $1 » n’a pas de pages.',
	'spl-subpages-par-sort' => 'Le sens de tri. Valeurs permises: "asc" et "desc".',
	'spl-subpages-par-sortby' => 'Selon quoi trier les sous-pages. Valeurs permises: "title" ou "lastedit".',
	'spl-subpages-par-format' => 'La liste des sous-pages peut être affichée selon différents formats. Valeurs permises: "ol" - listes ordonnées (numérotées), "ul" - listes non ordonnées (à puces), "list" -  listes simples (par exemple liste séparée par des virgules).',
	'spl-subpages-par-page' => "La page pour afficher les sous-pages, ou l'espace de nommage (y compris le deux-points final) dont les pages sont à afficher. Par défaut, la page courante.",
	'spl-subpages-par-showpage' => 'Indique si la page elle-même doit figurer dans la liste ou non.',
	'spl-subpages-par-pathstyle' => 'Le style de chemin pour les sous-pages dans la liste. Valeurs permises: "fullpagename" - nom complet de la page (y compris l\'espace de noms), "pagename" - nom de la page (sans l\'espace de noms), "subpagename" - nom relatif de la page en démarrant de la page depuis laquelle nous listons les sous-pages, "none" - uniquement la dernière partie du nom, après le dernier slash.',
	'spl-subpages-par-kidsonly' => "Permet de n'afficher que les sous-pages immédiates.",
	'spl-subpages-par-limit' => 'La quantité maximale de pages à lister.',
	'spl-subpages-par-element' => 'L\'élément HTML englobant la liste (y compris les textes "intro" et "outro" ou "default"). Valeurs permises: "div", "p", "span".',
	'spl-subpages-par-class' => "La valeur pour l'attribut HTML « class » encadrant la liste.",
	'spl-subpages-par-intro' => "Le texte à renvoyer avant la liste, si celle-ci n'est pas vide.",
	'spl-subpages-par-outro' => "Le texte à renvoyer après la liste, si celle-ci n'est pas vide.",
	'spl-subpages-par-default' => 'La texte à renvoyer à la place de la liste, si celle-ci est vide. S\'il est vide, un message d\'erreur sera renvoyé (comme "La page n\'a aucune sous-page à lister"). S\'il est mis à un tiret ("-"), le résultat sera complètement vide.',
	'spl-subpages-par-separator' => 'Le texte à renvoyer entre deux éléments de la liste, dans le cas d\'un format "list" (et son alias "bar"). N\'a pas d\'effet dans les autres formats.',
	'spl-subpages-par-template' => 'Le nom du modèle. Le modèle est appliqué à chaque élément de la liste. Un élément est passé comme premier argument (non nommé). Remarquez que le modèle n\'annule pas le formatage de la liste. Le formatage ("ul", "ol", "list") est appliqué au résultat du modèle.',
	'spl-subpages-par-links' => "S'il est vrai, les éléments de liste sont rendus comme des liens. S'il est faux, les éléments de liste sont rendus comme du texte simple. Ce dernier est particulièrement utile pour passer des éléments dans les modèles pour un traitement ultérieur.",
);

/** Franco-Provençal (arpetan)
 * @author ChrisPtDe
 */
$messages['frp'] = array(
	'spl-nosubpages' => 'Pâge « $1 » at gins de sot-pâge a ènumèrar.',
	'spl-noparentpage' => 'Pâge « $1 » ègziste pas.',
	'spl-nopages' => 'L’èspâço de noms « $1 » contint gins de pâge.',
	'spl-subpages-par-sort' => "La dirèccion de tri. Valors pèrmêses : « asc » (''crèssent'') et « desc » (''dècrèssent'').",
);

/** Galician (galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'spl-desc' => 'Engade unha etiqueta <code><nowiki><splist /></nowiki></code> que permite poñer as subpáxinas nunha lista',
	'spl-nosubpages' => 'A páxina "$1" non ten subpáxinas que poñer nunha lista.',
	'spl-noparentpage' => 'A páxina "$1" non existe.',
	'spl-nopages' => 'O espazo de nomes "$1" non ten páxinas.',
	'spl-subpages-par-sort' => 'A dirección de ordenación. Valores permitidos: "asc" e "desc".',
	'spl-subpages-par-sortby' => 'O criterio de ordenación das subpáxinas. Valores permitidos: "title" ou "lastedit"',
	'spl-subpages-par-format' => 'A lista de subpáxinas pódese mostrar en varios formatos. Valores permitidos: "ol", listas ordenadas (numeradas); "ul", listas desordenadas (con asteriscos); e "list", listas simples (por exemplo, separadas por comas).',
	'spl-subpages-par-page' => 'A páxina na que mostrar as subpáxinas ou o espazo de nomes (incluídos os dous puntos) no que mostrar as páxinas. A páxina actual é a predeterminada.',
	'spl-subpages-par-showpage' => 'Indica se a páxina en si debería figurar ou non na lista.',
	'spl-subpages-par-pathstyle' => 'O estilo da ruta de acceso ás subpáxinas da lista. Valores permitidos: "fullpagename", nome completo da páxina (incluído o espazo de nomes); "pagename", nome da páxina (sen o espazo de nomes); "subpagename", nome relativo da páxina comezando a partir daquela da que se van poñer as subpáxinas nunha lista; e "none", unicamente a parte do nome despois da última barra inclinada.',
	'spl-subpages-par-kidsonly' => 'Permite mostrar só as subpáxinas directas.',
	'spl-subpages-par-limit' => 'O número máximo de páxinas a poñer nunha lista.',
	'spl-subpages-par-element' => 'O elemento HTML que engloba a lista (incluíndo os textos "intro" e "outro" ou "default"). Valores permitidos: "div", "p" e "span".',
	'spl-subpages-par-class' => 'O valor para o atributo "class" do elemento HTML que engloba a lista.',
	'spl-subpages-par-intro' => 'O texto que mostrar antes da lista, se esta non está baleira.',
	'spl-subpages-par-outro' => 'O texto que mostrar despois da lista, se esta non está baleira.',
	'spl-subpages-par-default' => 'O texto que mostrar no canto da lista, se esta está baleira. Nesta caso, aparecerá unha mensaxe de erro (como "A páxina non ten subpáxinas que poñer nunha lista"). Se o valor fose un guión ("-"), o resultado sería completamente baleiro.',
	'spl-subpages-par-separator' => 'O texto que mostrar entre dous elementos da lista en caso dun formato "list" (e o seu idéntico "bar"). Non ten efecto sobre outros formatos.',
	'spl-subpages-par-template' => 'O nome do modelo. O modelo aplícase a cada elemento da lista. Un elemento é tratado como o primeiro argumento (sen nome). Nótese que o modelo non cancelar o formato da lista. O formato ("ul", "ol", "list") aplícase ao resultado do modelo.',
	'spl-subpages-par-links' => 'Se fose verdadeiro, os elementos da lista preséntanse como ligazóns. En caso de ser falso, os elementos da lista móstranse como texto simple. Isto último é especialmente útil para presentar elementos nos modelos para procesalos posteriormente.',
);

/** Hebrew (עברית)
 * @author Amire80
 * @author חיים
 */
$messages['he'] = array(
	'spl-desc' => 'הוספת התג <code><nowiki><splist /></nowiki></code> ליצירת רשימת דפי־משנה',
	'spl-nosubpages' => 'לדף "$1" אין דפי משנה שאפשר להציג ברשימה.',
	'spl-subpages-par-sort' => 'לאיזה כיוון למיין. ערכים מותרים: "עולה", "יורד".',
	'spl-subpages-par-sortby' => 'לפי מה למיין עמודי המשנה. ערכים מותרים: "כותרת" או "נערך לאחרונה".',
	'spl-subpages-par-format' => 'רשימת דפי־המשנה יכולה להיות מוצגת במספר עיצובים. רשימה ממוספרת (ol), רשימת תבליטים (ul), ורשימה מופרדת בפסיקים (list).', # Fuzzy
	'spl-subpages-par-page' => 'על איזה דף להציג את דפי־המשנה. בררת המחדל: הדף הנוכחי.', # Fuzzy
	'spl-subpages-par-showpage' => 'מציין אם הדף עצמו צריך להיות מוצג ברשימה או לאו.',
	'spl-subpages-par-pathstyle' => 'סגנון הנתיב אל דפי־המשנה ברשימה.', # Fuzzy
	'spl-subpages-par-kidsonly' => 'מאפשר להראות רק דפי־משנה ישירים.',
	'spl-subpages-par-limit' => 'המספר המרבי של דפים להציג.',
);

/** Upper Sorbian (hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'spl-desc' => 'Přidawa element <code><nowiki><splist /></nowiki></code>, kotryž ći zmóžnja podstrony nalistować',
	'spl-nosubpages' => 'Strona "$1" nima podstrony za lisćinu.',
	'spl-noparentpage' => 'Strona "$1" njeeksistuje',
	'spl-nopages' => 'W mjenowym rumje "$1" strony njejsu.',
	'spl-subpages-par-sort' => 'Sortěrowanski porjad. Dowolene hódnoty: "asc" (postupowacy) a "desc" (spadowacy).',
	'spl-subpages-par-sortby' => 'Sortěrowanski kriterij podstronow. Dowolene hódnoty: "title" (titul) abo "lastedit" (poslednja změna)',
	'spl-subpages-par-format' => 'Lisćina podstronow hodźi so we wšelakich formatach zwobraznić. Dowolene hódnoty: "ol" - (čisłowana lisćina), "ul" - naličenje (nječisłowana lisćina), "list" - jednora lisćina (za na př. lisćinu z přez komu dźělenymi zapiskami).',
	'spl-subpages-par-page' => 'Strona, za kotruž maja so podstrony pokazać, abo mjenowy rum (inkluziwnje dwudypka), w kotrymž strony maja so  pokazać. Standard je aktualna strona.',
	'spl-subpages-par-showpage' => 'Podawa, hač strona sama měła so w lisćinje pokazać abo nic.',
	'spl-subpages-par-pathstyle' => 'Stil šćežki za podstrony w lisćinje. Dowolene hódnoty: "fullpagename" — mjeno strony inkluziwnje mjenoweho ruma, "pagename" — mjeno strony bjez mjenoweho ruma, "subpagename" — relatiwne mjeno strony započinajo ze stronu, za kotruž so podstrony nalistuja, "none" — jenož tón dźěl mjena, kotryž poslednjej nakósnej smužce slěduje.',
	'spl-subpages-par-kidsonly' => 'Móže  jenož direktne podstrony pokazać.',
	'spl-subpages-par-limit' => 'Maksimalna ličba stronow, kotrež maja so nalsitować.',
	'spl-subpages-par-element' => 'HTML-element, kotryž ma lisćinu wopřijeć (inkluziwnje teksty "intro" a "outro" abo "standard"). Dowolene hódnoty: "div", "p", "span".',
	'spl-subpages-par-class' => 'Hódnota atributa "class" HTML-elementa, kotryž lisćinu wopřijima.',
	'spl-subpages-par-intro' => 'Tekst, kotryž ma so před lisćinu wudać, jeli lisćina prózdna njeje.',
	'spl-subpages-par-outro' => 'Tekst, kotryž ma so po lisćinje wudać, jeli lisćina prózdna njeje.',
	'spl-subpages-par-default' => 'Tekst, kotryž ma so město lisćiny wudać, jeli lisćina je prózdna. Jeli je prózdna, wuda so zmylkowa zdźělenka (na př. "Strona podstrony nima"). Jeli wjazawku ("-") wobsahuje, budźe wuslědk cyle pródzny.',
	'spl-subpages-par-separator' => 'Tekst, kotryž ma so mjez dwěmaj lisćinowymaj zapiskomaj, jeli so format "list" (abo jeho alis "bar") wužiwa. To nima wuskutk na druhe formaty.',
	'spl-subpages-par-template' => 'Mjeno předłohi. Předłoha nałožuje so na kóždy zapisk lisćiny. Zapisk přepodawa so jako prěni argument (bjez mjena). Wobkedźbuj, zo předłoha njepřetorhnje formatowanje lisćiny. Formatowanje ("ul", "ol", "list") nałožuje so na wuslědk předłohi.',
	'spl-subpages-par-links' => 'Jeli zmóžnjene, lisćinowe zapiski zwobraznjeja so jako wotkazy. Jeli znjemóžnjene, lisćinowe zapiski zwobraznjeja so jako luty tekst. Druhi pad je wosebje wužitny za přepodawanje zapiskow do předłohow za dalše předźěłowanje.',
);

/** Interlingua (interlingua)
 * @author McDutchie
 */
$messages['ia'] = array(
	'spl-desc' => 'Adde un etiquetta <code><nowiki><splist /></nowiki></code> que permitte listar subpaginas',
	'spl-nosubpages' => 'Le pagina "$1" non ha subpaginas a listar.',
	'spl-noparentpage' => 'Le pagina "$1" non existe.',
	'spl-nopages' => 'Le spatio de nomines "$1" non ha paginas.',
	'spl-subpages-par-sort' => 'Le direction in le qual ordinar. Valores permittite: "asc" e "desc".',
	'spl-subpages-par-sortby' => 'Criterio secundo le qual ordinar le subpaginas. Valores permittite: "title" (titulo) o "lastedit" (ultime modification).',
	'spl-subpages-par-format' => 'Le lista de subpaginas pote esser presentate in plure formatos. Valores permittite: "ol" — lista ordinate (con numeros), "ul" — lista non ordinate (con punctos), "list" — lista simple (p.ex. un lista separate per commas).',
	'spl-subpages-par-page' => 'Le pagina del qual presentar le subpaginas, o le nomine del spatio de nomines (incluse le duo punctos final) del qual presentar le paginas. Le predefinition es le pagina actual.',
	'spl-subpages-par-showpage' => 'Indica si le pagina mesme debe figurar in le lista o non.',
	'spl-subpages-par-pathstyle' => 'Le stilo del cammino pro subpaginas in le lista. Valores permittite: "fullpagename" — nomine complete del pagina (incluse le spatio de nomines), "pagename" — nomine del pagina (sin spatio de nomines), "subpagename" — nomine relative del pagina, comenciante al pagina del qual nos lista le subpaginas, "none" — solmente le parte final del nomine post le ultime barra oblique.',
	'spl-subpages-par-kidsonly' => 'Permitte monstrar solmente subpaginas directe.',
	'spl-subpages-par-limit' => 'Le numero maxime de paginas a listar.',
	'spl-subpages-par-element' => 'Le elemento HTML que circumfere le lista (incluse le textos "intro" e "outro" o "default"). Valores permittite: "div", "p", "span".',
	'spl-subpages-par-class' => 'Le valor del attributo "class" del elemento HTML que circumfere le lista.',
	'spl-subpages-par-intro' => 'Le texto a presentar ante le lista, si le lista non es vacue.',
	'spl-subpages-par-outro' => 'Le texto a presentar post le lista, si le lista non es vacue.',
	'spl-subpages-par-default' => 'Le texto a presentar in loco del lista, si le lista es vacue. Si vacue, un message de error essera rendite (como "Le pagina non ha subpaginas a listar"). Si es un lineetta ("-"), le resultato essera completemente vacue.',
	'spl-subpages-par-separator' => 'Le texto a presentar inter duo elementos del lista in caso del formatos "list" o "bar". Non ha effecto in altere formatos.',
	'spl-subpages-par-template' => 'Le nomine del patrono. Le patrono es applicate a cata elemento del lista. Un elemento es passate como le prime argumento (sin nomine). Nota que le patrono non cancella le formatation del lista. Le formatation ("ul", "ol", "list") es applicate al resultato del patrono.',
	'spl-subpages-par-links' => 'Si ver, le elementos del lista es rendite como ligamines. Si false, le elementos del lista es rendite como texto simple. Iste ultime option es particularmente utile pro passar elementos a in patronos pro ulterior processamento.',
);

/** Indonesian (Bahasa Indonesia)
 * @author IvanLanin
 */
$messages['id'] = array(
	'spl-desc' => 'Memberikan tag <code><nowiki><splist /></nowiki></code> yang memungkinkan Anda untuk melihat daftar subhalaman',
	'spl-nosubpages' => '$1 tidak memiliki subhalaman untuk ditampilkan.', # Fuzzy
	'spl-subpages-par-sort' => 'Arah urutan.', # Fuzzy
	'spl-subpages-par-sortby' => 'Cara pengurutan subhalaman.', # Fuzzy
	'spl-subpages-par-format' => 'Daftar subhalaman dapat ditampilkan dalam berbagai format, yaitu daftar bernomor (ol), daftar butir (ul), dan daftar dipisahkan koma (list).', # Fuzzy
	'spl-subpages-par-page' => 'Halaman yang akan ditampilkan subhalamannya. Setelan bawaan: halaman saat ini.', # Fuzzy
	'spl-subpages-par-showpage' => 'Menunjukkan apakah halaman itu sendiri harus ditampilkan atau tidak dalam daftar.',
	'spl-subpages-par-pathstyle' => 'Gaya jalur subhalaman dalam daftar.', # Fuzzy
	'spl-subpages-par-kidsonly' => 'Hanya tampilkan subhalaman langsung.',
	'spl-subpages-par-limit' => 'Jumlah halaman maks. yang ditampilkan.',
);

/** Italian (italiano)
 * @author Beta16
 * @author F. Cosoleto
 */
$messages['it'] = array(
	'spl-desc' => 'Aggiunge un tag <code><nowiki><splist /></nowiki></code> che consente di elencare le sottopagine',
	'spl-nosubpages' => 'La pagina "$1" non ha alcuna sottopagina da elencare.',
	'spl-noparentpage' => 'La pagina "$1" non esiste.',
	'spl-nopages' => 'Il namespace "$1" non ha pagine.',
	'spl-subpages-par-limit' => 'Il numero massimo di pagine da elencare.',
);

/** Japanese (日本語)
 * @author Schu
 * @author Shirayuki
 */
$messages['ja'] = array(
	'spl-desc' => '下位ページを列挙してその件数を表示できるようにする',
	'spl-nosubpages' => 'ページ「$1」には列挙できる下位ページがありません。',
	'spl-noparentpage' => 'ページ「$1」は存在しません。',
	'spl-nopages' => '名前空間「$1」にはページはありません。',
	'spl-subpages-par-sort' => '並べ替えの順序です。使用できる値:「asc」、「desc」',
	'spl-subpages-par-sortby' => '下位ページの並べ替えの基準です。使用できる値:「title」「lastedit」',
	'spl-subpages-par-format' => '下位ページは複数の形式で出力できます。使用できる値:「ol」(番号付きリスト)、「ul」(番号なしリスト)、「list」(プレーンなリスト (例: カンマ区切り))',
	'spl-subpages-par-page' => '下位ページを表示するページ、またはページを表示する名前空間名 (末尾のコロンを含む) です。既定は現在のページです。',
	'spl-subpages-par-showpage' => 'そのページ自身を一覧に含めるかどうかを指定します。',
	'spl-subpages-par-pathstyle' => '一覧での下位ページのパスのスタイルです。使用できる値:「fullpagename」(完全なページ名 (名前空間を含む))、「pagename」(ページ名 (名前空間を含まない))、「subpagename」(列挙を開始したページからの相対ページ名)、「none」(最後のスラッシュの後の部分のみ)',
	'spl-subpages-par-kidsonly' => '直接の下位ページのみを表示できるようにします。',
	'spl-subpages-par-limit' => 'ページを列挙する件数の最大値です。',
	'spl-subpages-par-element' => '一覧を囲む HTML 要素 (「intro」「outro」「default」のテキストを含む) です。使用できる値:「div」「p」「span」',
	'spl-subpages-par-class' => '一覧を囲む HTML 要素の「class」属性の値です。',
	'spl-subpages-par-intro' => '一覧が空ではない場合に、一覧の前に出力するテキストです。',
	'spl-subpages-par-outro' => '一覧が空ではない場合に、一覧の後に出力するテキストです。',
	'spl-subpages-par-default' => '一覧が空の場合にその代わりに出力するテキストです。空にした場合は、エラーメッセージ (例:「ページには列挙できる下位ページがありません」) を出力します。ダッシュ (-) を指定した場合は、まったく何も出力しません。',
	'spl-subpages-par-separator' => '「list」形式 (およびその別名「bar」形式) の場合に、一覧の各項目の間に出力するテキストです。他の形式の場合には影響しません。',
	'spl-subpages-par-template' => 'テンプレート名です。指定したテンプレートは一覧の各項目に適用されます。テンプレートの最初の (無名の) 引数として、項目が渡されます。テンプレートは一覧の形式をキャンセルしない、ということにご注意ください。テンプレートの出力に対して、一覧の形式 (「ol」「ol」「list」) が適用されます。',
	'spl-subpages-par-links' => 'true にすると一覧の項目はリンクとして出力され、false にするとテキスト形式で出力されます。後者は特に、出力した項目をさらにテンプレートに渡す際に役立ちます。',
);

/** Georgian (ქართული)
 * @author David1010
 */
$messages['ka'] = array(
	'spl-noparentpage' => 'გვერდი „$1“ არ არსებობს.',
	'spl-subpages-par-limit' => 'სიაში გვერდების მაქსიმალური რაოდენობა.',
);

/** Korean (한국어)
 * @author 아라
 */
$messages['ko'] = array(
	'spl-desc' => '하위 문서를 나타내도록 하는 <code><nowiki><splist /></nowiki></code> 태그를 추가합니다',
	'spl-nosubpages' => '"$1" 문서는 목록에 하위 문서가 없습니다.',
	'spl-noparentpage' => '"$1" 문서가 존재하지 않습니다.',
	'spl-nopages' => '"$1" 이름공간에 문서가 없습니다.',
	'spl-subpages-par-sort' => '정렬할 방향입니다. 허용하는 값: "asc"와 "desc"입니다.',
	'spl-subpages-par-sortby' => '하위 문서를 정렬할 기준입니다. 허용하는 값: "title"이나 "lastedit"입니다.',
	'spl-subpages-par-format' => '하위 문서 목록은 여러 가지 형식으로 보여줄 수 있습니다. 허용하는 값: "ol" — 순서 있는(번호를 매긴) 목록, "ul" — 순서 없는(불릿으로 된) 목록, "list" — 일반 목록 (예를 들어 쉼표로 구분한 목록)입니다.',
	'spl-subpages-par-page' => '문서를 보여줄 하위 문서나 이름공간 이름(뒤에 콜론 포함)을 보여줄 문서입니다. 현재 문서는 기본값입니다.',
	'spl-subpages-par-showpage' => '문서 자체가 목록에 여부를 보여줘야 하는지 여부를 나타냅니다.',
	'spl-subpages-par-pathstyle' => '목록에서 하위 문서에 대한 경로의 스타일입니다. 허용하는 값: "fullpagename" — (이름공간을 포함한) 전체 문서 이름, "pagename" — (이름공간 없는) 문서 이름, "subpagename" — 하위 문서를 나타낼 문서에서 시작하는 관련된 문서 이름, "none" — 그냥 마지막 슬래시 뒤에 이름의 일부의 끝입니다.',
	'spl-subpages-par-kidsonly' => '직접 하위 문서만 보여줄 수 있습니다.',
	'spl-subpages-par-limit' => '나타낼 문서의 최대 수입니다.',
	'spl-subpages-par-element' => '목록을 둘러싼 ("intro"와 "outro" 또는 "default" 텍스트를 포함하는) HTML 요소입니다. 허용하는 값: "div", "p", "span"입니다.',
	'spl-subpages-par-class' => '목록을 둘러싼 HTML 요소의 "class" 특성에 대한 값입니다.',
	'spl-subpages-par-intro' => '목록이 비어 있지 않다면 목록 앞에 출력할 텍스트입니다.',
	'spl-subpages-par-outro' => '목록이 비어 있지 않다면 목록 뒤에 출력할 텍스트입니다.',
	'spl-subpages-par-default' => '목록이 비어 있다면 목록 대신 출력할 텍스트입니다. 비어 있다면 ("문서는 나타낼 하위 문서가 없습니다"와 같이) 오류 메시지가 나타납니다. 대시("-")로 입력하면 결과는 완전히 비어있게 됩니다.',
	'spl-subpages-par-separator' => '"list"(별명 "bar") 형식일 때 목록 항목 두 개 사이에 출력할 텍스트입니다. 다른 형식에는 영향이 없습니다.',
	'spl-subpages-par-template' => '틀 이름입니다. 틀은 목록의 모든 항목에 적용됩니다. 항목은 (이름 없는) 첫 인수로 전달합니다. 해당 틀은 목록 형식을 취소하지 않음을 참고하세요. 형식("ul", "ol", "list")은 틀의 결과에 적용됩니다.',
	'spl-subpages-par-links' => '사실(true)이면 목록 항목은 링크로 표시합니다. 거짓(false)이면 목록 항목은 일반 텍스트로 표시합니다. 후자는 더 많이 처리하기 위해 틀에 항목을 건너 뛰는 데 특히 도움이 됩니다.',
);

/** Colognian (Ripoarisch)
 * @author Purodha
 */
$messages['ksh'] = array(
	'spl-desc' => 'Deiht dä Befähl <code><nowiki><splist /></nowiki></code> en et Wiki, för Ongersigge aanzezeije.',
	'spl-nosubpages' => 'Di Sigg „$1“ hät kein Ongersigge zom Opleßte.',
	'spl-noparentpage' => 'En Sigg „$1“ jidd_et nit.',
	'spl-nopages' => 'Dat Appachtemang „$1“ hät kein Sigge.',
	'spl-subpages-par-sort' => 'Wieröm zoteet wääde sull, mer kann <code lang="en">asc</code> för opwääds un <code lang="en">desc</code> för retuurwääds aanjävve.',
	'spl-subpages-par-sortby' => 'Noh wat de Ongersigge zoteet wääde sulle, mer kann <code lang="en">title</code> för der Tittel un <code lang="en">lastedit</code> för et Dattum un de Zig vun de läzde Änderong aanjävve.',
	'spl-subpages-par-format' => '!De Leß met de Ongersigge kann ongerscheidlijje Jeschtalte han: met Nummere (<code>ol</code>) met Punkte (<code>ul</code>) un alles ein eine Reih met Kommas dozwesche (<code>list</code>)',
	'spl-subpages-par-page' => 'De Sigg, woh de Ongersigge vun jezeich wääde sulle. Wam_mer nix säät, es dat de Sigg, di jraad jezeich weed. Wann ene Dubbelpungk aam Ängk es, ess-et an Appachtemang un däm sing Sigge wääde jezeisch.',
	'spl-subpages-par-showpage' => 'Jitt aan, ov de Sigg selver och en dä Leß met dä iehre Ongersigge aanjezeisch wääde sull, udder nit.',
	'spl-subpages-par-pathstyle' => 'Dä Stil vun de Aanzeije vun däm Pad vun de Ongersigge en dä Leß.
Zohjelohße es:
<code lang="en">fullpagename</code> — Dä janze Name vun dä Sigg mem Appachtemang.
<code lang="en">pagename</code> — Dä janze Name vun dä Sigg der ohne et Appachtemang.
<code lang="en">subpagename</code> — Bloß der Deil vum Name henger dä Sigg, woh mer Ongersigge vun opleste donn.
<code lang="en">none</code> — Blos et Engk vum Name henger_em läzde schrääje Schtresch.',
	'spl-subpages-par-kidsonly' => 'Määt et müjjelesch, bloß de diräkte Ongersigge opzeleßte.',
	'spl-subpages-par-limit' => 'De jrüüßte Zahl Sigge för opzeleste.',
	'spl-subpages-par-class' => 'Dä Wäät för dat „<code lang="en">class</code>“-Attribut vun däm <i lang="en">HTML</i>-Elemänt, woh di Leß dren es.',
	'spl-subpages-par-intro' => 'Der Täx vör der Leß, wann se nit läddesch es',
	'spl-subpages-par-outro' => 'Der Täx henger der Leß, wann se nit läddesch es',
	'spl-subpages-par-separator' => 'Dä Täx, dä zwesche zwei Endrääsch en de Leß ußjejovve wääde sull. Wann et Fommaat nit <code>list</code> es, deiht dat heh nix.',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Les Meloures
 * @author Robby
 * @author Soued031
 */
$messages['lb'] = array(
	'spl-desc' => 'Erlaabt et Ënnersäiten ze weisen an ze zielen',
	'spl-nosubpages' => 'D\'Säit "$1" huet keng Ënnersäite fir ze weisen.',
	'spl-noparentpage' => 'D\'Säit "$1" gëtt et net.',
	'spl-nopages' => 'Am Nummraum "$1" gëtt et keng Säiten.',
	'spl-subpages-par-sort' => 'Reiefolleg wéi zortéiert soll ginn. Erlaabt Wäerter: "asc" an "desc".',
	'spl-subpages-par-sortby' => 'Wourop d\'Ënnersäiten zortéiert ginn. Erlaabt Wäerter: "titel" oder "lescht Ännerung".',
	'spl-subpages-par-format' => 'D\'Lëscht vun den Ënnersäite kann a verschiddene Formater gewise ginn. Erlaabt Wäerter: "ol" Numeréiert Lëschten, "ul" Lëschte mat Punkten, "list" ganz Lëschten (z. Bsp. "comma seperated" Lëscht).',
	'spl-subpages-par-page' => "D'Säit fir déi Ënnersäite gewise solle ginn, oder Numm vum Nummraum (inklusiv den Doppelpunkt) an deem Säite solle gewise ginn. Als Standard ass dat déi aktuell Säit.",
	'spl-subpages-par-showpage' => "Gëtt un ob d'Säit selwer an der Lëscht gewise soll ginn oder net.",
	'spl-subpages-par-pathstyle' => 'Styl vum Wee (path) fir Ënnersäiten an der Lëscht. Erlaabt Wäerter: "fullpagename" - Kompletten Numm vun der Säit (inklusiv den Nummraum), "pagename" - Numm vun der Säit (ouni Nummraum), "subpagename" - Relativen Numm vun der Säit ugefaang bei der Säit fir déi mir Ënnersäiten opzielen, "none" -  just deen Deel vum Numm deen no dem leschte Slash kënnt.',
	'spl-subpages-par-kidsonly' => 'Erlaabt fir nëmmen direkt Ënnersäiten ze weisen.',
	'spl-subpages-par-limit' => "D'Maximalzuel vu Säiten déi gewise ginn.",
	'spl-subpages-par-intro' => 'Den Text virun der Lëscht, wann se net eidel ass.',
	'spl-subpages-par-outro' => 'Den Text hanner der Lëscht, wa se net eidel ass.',
	'spl-subpages-par-default' => 'Den Text deen gewise amplaz vun der Lëscht gëtt, wann d\'Lëscht eidel ass. Wa s\'eidel ass, gëtt e Feelermessage generéiert (sou wéi "D\'Säit huet keng Ënnersäiten"). Wann et e bindestrich ass ("-"), ass d\'Resultat komplett eidel.',
	'spl-subpages-par-template' => 'Den Numm vun der Schabloun. D\'Schabloun gëtt fir all Element vun der Lëscht benotzt. Een Element gëtt als éischt (ongenannt) Argument un D\'Schabloun viruginn. Denkt drun datt d\'Schabloun de Format vun der Lëscht net ännert. D\'Formatéierung ("ul", "ol", "list") gëtt op d\'Resultat vun der Schabloun applizéiert.',
	'spl-subpages-par-links' => "Wann et aktivéiert ass ginn d'Elementer vun der Lëscht als Linken duergestallt. Wann et net aktivéiert ass ginn d'Elementer vun der Lëscht als normalen Text duergestallt. Déi lescht Optioun ass besonnesch nëtzlech fir Elementer a Schablounen anzebannen an duerno weider ze verschaffen.",
);

/** Macedonian (македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'spl-desc' => 'Овозможува испишување и броење на страници',
	'spl-nosubpages' => 'Страницата „$1“ нема потстраници за наведување.',
	'spl-noparentpage' => 'Страницата „$1“ не постои.',
	'spl-nopages' => 'Именскиот простор „$1“ нема страници.',
	'spl-subpages-par-sort' => '!Насока на подредување. Допуштени вредности: „asc“ и „desc“.',
	'spl-subpages-par-sortby' => 'По што да се подредат потстраниците. Допуштени вредности: „title“ or „lastedit“.',
	'spl-subpages-par-format' => 'Списокот на потстраници може да се прикаже во неколку формати. Допуштени вредности: „ol“ — подреден список (со бројки), „ul“ — неподредени списоци (потточки), „list“ прости списоци (на пр. список одделем со запирки).',
	'spl-subpages-par-page' => 'За која страница да се прикажат потстраниците, или називот на именскиот простор (вклучувајќи ги двете точки на крајот). По основно - тековната страница.',
	'spl-subpages-par-showpage' => 'Назначува дали во списокот да се прикаже и самата страница.',
	'spl-subpages-par-pathstyle' => 'Стилот на патеката за потстраниците во списокот. Допуштени вредности: „fullpagename“ — полно име на страницата (вклучувајќи го именскиот простор), „pagename“ — име на страницата (без именски простор), „subpagename“ — релативно име на страницата почнувајќи од страницата за која наведуваме потстраници, „none“ — само последниот дел од името што се наоѓа по последната коса црта.',
	'spl-subpages-par-kidsonly' => 'Овозможува приказ само на директни потстраници.',
	'spl-subpages-par-limit' => 'Максималниот број на страници за наведување во списокот.',
	'spl-subpages-par-element' => 'HTML-елементот што го опколува списокот (вклучувајќи ги текстовите во „intro“ и „outro“ или пак „default“). Допуштени вредности: „div“, „p“, „span“.',
	'spl-subpages-par-class' => 'Вредноста за атрибутот „class“ на HTML-елементот што го обиколува списокот.',
	'spl-subpages-par-intro' => 'Текстот пред сисокот, ако списокот не е празен.',
	'spl-subpages-par-outro' => 'Текстот по сисокот, ако списокот не е празен.',
	'spl-subpages-par-default' => 'Текстот за приказ наместо списокот, ако списокот е празен. Ако е празна, ќе се појави порака за грешка (како „Страницата нема потстраници“). Ако има цртичка („-“), резултатот ќе биде сосем празен.',
	'spl-subpages-par-separator' => 'Текстот помеѓу две ставки во списокот за форматите „list“ или „bar“. Не дејствува на другите формати.',
	'spl-subpages-par-template' => 'Името на шаблонот. Шаблонот се применува врз секоја ставка во списокот. Како прв (неименуван) аргумент се зема ставка. Имајте предвид дека шаблонот не го поништува форматирањето на списокот. Врз резултатот на шаблонот се применува форматирање („ul“, „ol“, „list“).',
	'spl-subpages-par-links' => 'Ако е точно, ставките во списокот се прикажуваат како врски. Ако е неточно, тогаш ставките се прикажуваат како прост текст. Второспоменатото е особено корисно за доставка на ставки во шаблони за понатамошна обработка.',
);

/** Malay (Bahasa Melayu)
 * @author Anakmalaysia
 */
$messages['ms'] = array(
	'spl-desc' => 'Membubuh teg <code><nowiki><splist /></nowiki></code> yang membolehkan anda untuk melihat senarai sublaman',
	'spl-nosubpages' => 'Halaman "$1" tidak menyenaraikan sebarang subhalaman.',
	'spl-noparentpage' => 'Halaman "$1" tidak wujud.',
	'spl-nopages' => 'Ruang nama "$1" tiada halaman.',
	'spl-subpages-par-sort' => 'Arah isihan. Nilai-nilai yang dibenarkan: "asc" (menaik) dan "desc" (menurun).',
	'spl-subpages-par-sortby' => 'Apa yang diikut untuk mengisih sublaman. Nilai-nilai yang dibenarkan: "title" (tajuk) atau "lastedit" (suntingan terakhir).',
	'spl-subpages-par-format' => 'Senarai sublaman boleh dipaparkan dalam beberapa format. Nilai-nilai yang dibenarkan: "ol" — senarai tertib (bernombor), "ul" — senarai tak tertib (berbunga), "list" — senarai biasa (cth: senarai yang diasingkan dengan koma).',
	'spl-subpages-par-page' => 'Halaman untuk memaparkan subhalaman, atau ruang nama (diikuti oleh tanda titik bertindih) untuk memaparkan halaman. Yang azali adalah halaman semasa.',
	'spl-subpages-par-showpage' => 'Menandakan sama ada halaman itu harus dipaparkan dalam senarai atau tidak.',
	'spl-subpages-par-pathstyle' => 'Gaya laluan untuk subhalaman-subhalaman dalam senarai. Nilai-nilai yang dibenarkan: "fullpagename" — nama penuh halaman (termasuk ruang nama), "pagename" — nama halaman (tanpa ruang nama), "subpagename" — nama halaman relatif yang bermula dari halaman untuk kita senaraikan subhalaman, "none" — hanya ekor nama selepas tanda condong terakhir.',
	'spl-subpages-par-kidsonly' => 'Membenarkan paparan subhalaman langsung sahaja.',
	'spl-subpages-par-limit' => 'Bilangan halaman maksimum yang hendak disenaraikan.',
	'spl-subpages-par-element' => 'Elemen HTML yang memagari senarai (termasuk "intro" dan "outro" atau "default"). Nilai-nilai yang dibenarkan: "div", "p", "span".',
	'spl-subpages-par-class' => 'Nilai untuk atribut "class" pada elemen-elemen HTML yang memagari senarai.',
	'spl-subpages-par-intro' => 'Teks yang hendak disiarkan sebelum senarai, jika senarai tidak kosong.',
	'spl-subpages-par-outro' => 'Teks yang hendak disiarkan selepas senarai, jika senarai tidak kosong.',
	'spl-subpages-par-default' => 'Teks yang hendak disiarkan sebagai ganti senarai jika senarai itu kosong. Jika kosong, maka terpaparnya mesej ralat (seperti "Halaman ini tidak menyenaraikan sebarang subhalaman.") Jika tanda sengkang ("-"), hasilnya kosong sama sekali.',
	'spl-subpages-par-separator' => 'Teks yang hendak disiarkan di antara dua perkara senarai seandainya terdapat format "list" (atau "bar"). Tiada kesan pada format-format lain.',
	'spl-subpages-par-template' => 'Nama templat. Templat diterapkan pada setiap perkara dalam senarai. Satu perkara diserahkan sebagai hujah pertama (yang tanpa nama). Ingat, templat ini tidak membatalkan formatan senarai. Formatan ("ul", "ol", "list") diterapkan pada hasil templat.',
	'spl-subpages-par-links' => 'Jika benar, perkara-perkara dalam senarai dipaparkan sebagai pautan. Jika palsu, perkara-perkara dalam senarai dipaparkan sebagai teks biasa. Yang palsu berguna khususnya untuk menyerahkan perkara-perkara ke dalam templat untuk pemprosesan selanjutnya.',
);

/** Maltese (Malti)
 * @author Chrisportelli
 */
$messages['mt'] = array(
	'spl-desc' => 'Iżżid <code><nowiki><splist /></nowiki></code> li tippermetti l-elenkar tas-sottopaġni',
	'spl-nosubpages' => 'Il-paġna "$1" m\'għandha l-ebda sottokategorija għal-lista.',
	'spl-noparentpage' => 'Il-paġna "$1" ma teżistix.',
	'spl-nopages' => 'L-ispazju tal-isem "$1" m\'għandux paġni.',
	'spl-subpages-par-sort' => 'Id-direzzjoni kif tirranġahom. Valuri permessi: "asc" u "desc".',
);

/** Norwegian Bokmål (norsk bokmål)
 * @author Nghtwlkr
 */
$messages['nb'] = array(
	'spl-desc' => 'Legger til et <code><nowiki><splist /></nowiki></code>-element som lar deg liste opp undersider',
	'spl-nosubpages' => '$1 har ingen undersider å liste opp.', # Fuzzy
	'spl-subpages-par-sort' => 'Retningen du vil sortere i.', # Fuzzy
	'spl-subpages-par-sortby' => 'Hva du vil sortere undersidene etter.', # Fuzzy
	'spl-subpages-par-format' => 'Undersidelisten kan vises i flere format. Nummererte lister (ol), punktlister (ul) og kommaseparerte lister (list).', # Fuzzy
	'spl-subpages-par-page' => 'Siden undersidene skal vises for. Standard er den gjeldende siden.', # Fuzzy
	'spl-subpages-par-showpage' => 'Indikerer om selve siden skal vises i listen eller ikke.',
	'spl-subpages-par-pathstyle' => 'Stilen på banen for undersidene i listen.', # Fuzzy
	'spl-subpages-par-kidsonly' => 'Tillater kun å vise direkte undersider.',
	'spl-subpages-par-limit' => 'Maksimum antall sider å liste opp.',
);

/** Dutch (Nederlands)
 * @author McDutchie
 * @author SPQRobin
 * @author Siebrand
 */
$messages['nl'] = array(
	'spl-desc' => "Maakt het mogelijk subpagina's weer te geven en te tellen",
	'spl-nosubpages' => 'Pagina "$1" heeft geen subpagina\'s.',
	'spl-noparentpage' => 'Pagina "$1" bestaat niet.',
	'spl-nopages' => 'Naamruimte "$1" heeft geen pagina\'s.',
	'spl-subpages-par-sort' => 'De richting voor de sorteervolgorde. Toegestande waarden: "asc" (oplopend") en "desc" (aflopend).',
	'spl-subpages-par-sortby' => 'Hoe de subpagina\'s te sorteren. Toegestane waarden: "title" (paginanaam) en "lastedit" (laatste bewerking).',
	'spl-subpages-par-format' => 'De lijst met subpagina\'s kan op verschillende manieren weergegeven worden. Als genummerde lijst ("ol"), ongenummerde lijst ("ul") en als door komma\'s gescheiden lijst ("list"), bijvoorbeeld een door komma\'s gescheiden lijst.',
	'spl-subpages-par-page' => "De pagina waarvoor subpagina's weergegeven moeten worden of een naamruimtenaam (inclusief de dubbele punt als achtervoegsel). Dit is standaard de huidige pagina.",
	'spl-subpages-par-showpage' => 'Geeft aan of de pagina zelf weergegeven moet worden in de lijst of niet.',
	'spl-subpages-par-pathstyle' => 'De stijl van het pad voor subpagina\'s in de lijst. Toegestane waarden: "fullpagename": volledige paginanaam, inclusief naamruimte, "pagename": paginanaam zonder naamruimte, "subpagename": relatieve paginanaam vanaf de pagina waarvoor subpagina\'s worden weergegeven, "none": alleen het achtervoegsel van de naam na de laatste slash.',
	'spl-subpages-par-kidsonly' => "Maakt het mogelijk om alleen subpagina's van het eerste niveau weer te geven.",
	'spl-subpages-par-limit' => "Het maximale aantal weer te geven pagina's.",
	'spl-subpages-par-element' => 'Het HTML-element dat de lijst omsluit (inclusief "intro"- en "outro"- of "default"-teksten). Toegestane waarden: "div", "p", "span".',
	'spl-subpages-par-class' => 'De waarde voor het "class"-attribuut van het HTML-element waarin de lijst is omsloten.',
	'spl-subpages-par-intro' => 'De uit te voeren tekst vóór de lijst als de lijst niet leeg is.',
	'spl-subpages-par-outro' => 'De uit te voeren tekst na de lijst, als de lijst niet leeg is.',
	'spl-subpages-par-default' => 'De weer te geven tekst in plaats van de lijst als de lijst leeg is. Als dit leeg is, wordt een foutmelding gegeven, zoals "Er zijn geen weer te geven subpagina\'s". Bij gebruik van het teken "-" is het resultaat volledig leeg.',
	'spl-subpages-par-separator' => 'De uit te voeren tekst tussen twee lijstelementen voor een "list" (lijstweergave) of "bar" (balkweergave). Dit heeft geen effect op andere weergaven.',
	'spl-subpages-par-template' => 'De naam van de sjabloon. De sjabloon wordt toegepast op ieder element in de lijst. Een element wordt doorgegeven als het eerste (onbenoemde) argument. Let op dat de sjabloon de lijstopmaak niet verwijdert; de opmaak ("ul", "ol" of "list") wordt toegepast op het resultaat van de sjabloon.',
	'spl-subpages-par-links' => 'Lijstelementen worden opgemaakt als koppelingen als waar. Lijstelementen zijn platte tekst als onwaar. De laatste optie is handig bij het doorgeven van elementen aan sjablonen voor verdere verwerking.',
);

/** Occitan (occitan)
 * @author Cedric31
 */
$messages['oc'] = array(
	'spl-desc' => 'Apond una balisa <nowiki><splist /></nowiki> que permet de far la lista de las sospaginas',
	'spl-nosubpages' => 'La pagina « $1 » a pas cap de sospaginas de listar.',
	'spl-noparentpage' => 'La pagina « $1 » existís pas.',
	'spl-nopages' => 'L’espaci de nom « $1 » a pas cap de paginas.',
);

/** Polish (polski)
 * @author BeginaFelicysym
 * @author Woytecr
 */
$messages['pl'] = array(
	'spl-desc' => 'Dodaje tag <code><nowiki><splist /></nowiki></code> pozwalający na wstawienie listy podstron',
	'spl-nosubpages' => 'Strona " $1 " nie ma podstron do wyświetlenia.',
	'spl-noparentpage' => 'Strona "$1" nie istnieje.',
	'spl-nopages' => 'Przestrzeń nazw "$1" nie zawiera stron.',
	'spl-subpages-par-sort' => 'Kierunek porządkowania. Dopuszczalne wartości: "asc" rosnąco i "desc" malejąco.',
	'spl-subpages-par-sortby' => 'Według czego uporządkować podstrony. Dopuszczalne wartości: "tytuł" lub "ostatniaedycja".',
	'spl-subpages-par-format' => 'Lista podstron może być wyświetlana w różnych formatach. Dopuszczalne wartości: "ol" — uporządkowana (numerowana) lista, "ul" — lista nieuporządkowana (wypunktowanie), "list" — zwykła lista (na przykład lista rozdzielana przecinkami).',
	'spl-subpages-par-page' => 'Strona, której podstrony mają być pokazane, lub przestrzeń nazw (włączając końcowy dwukropek), którejstrony wyświetlić. Domyślnie bieżąca strona.',
	'spl-subpages-par-showpage' => 'Wskazuje, czy sama strony powinna być wyświetlona na liście, czy też nie.',
	'spl-subpages-par-pathstyle' => 'Styl ścieżki dla podstron na liście. Dopuszczalne wartości: "fullpagename" — pełna nazwa strony (w tym obszar nazw), "pagename" — nazwa strony (bez przestrzeni nazw), "subpagename" — względna nazwa strony począwszy od strony podstawowej, "none" — tylko końcowa część nazwy po ostatnim ukośniku.',
	'spl-subpages-par-kidsonly' => 'Umożliwia pokazywanie tylko bezpośrednich podstron.',
	'spl-subpages-par-limit' => 'Maksymalna liczba stron do wyświetlenia.',
	'spl-subpages-par-element' => 'Element HTML, w którym zawarta będzie lista (w tym teksty "intro" i "outro" oraz "domyślny"). Dopuszczalne wartości: "div", "p", "span".',
	'spl-subpages-par-class' => 'Wartość atrybutu"class" elementu HTML otaczającego listę.',
	'spl-subpages-par-intro' => 'Tekst wyświetlany przed listą, gdy lista nie jest pusta.',
	'spl-subpages-par-outro' => 'Tekst wyświetlany po liście, gdy lista nie jest pusta.',
	'spl-subpages-par-default' => 'Tekst wyświetlany zamiast z listy, jeśli lista jest pusta. Jeśli pusty, będzie renderowany komunikat o błędzie (na przykład "Strona ma nie podstron do wyświetlenia"). Jeśli kreska ("-"), wynik będzie całkowicie pusty.',
	'spl-subpages-par-separator' => 'Tekst do wyświetlania między dwiema pozycjami listy w przypadku "list" (i jej aliasu "bar"). Nie ma zastosowania w innych formatach.',
	'spl-subpages-par-template' => 'Nazwa szablonu. Szablon zostanie zastosowany do każdego elementu listy. Element jest przekazywany jako pierwszy argument (bez nazwy). Należy zauważyć, że ten szablon nie anuluje formatowania listy. Formatowanie ("ul", "ol", "list") jest stosowane w wyniku tego szablonu.',
	'spl-subpages-par-links' => 'Jeśli true, elementy listy są renderowane jako łącza. Jeśli ma wartość false, elementy listy są renderowane jako zwykły tekst. To ostatnie jest szczególnie przydatne w przypadku przekazywania elementów do szablonów i dalszego przetwarzania.',
);

/** Piedmontese (Piemontèis)
 * @author Borichèt
 * @author Dragonòt
 */
$messages['pms'] = array(
	'spl-desc' => 'A gionta un sìmbol <code><nowiki><splist /></nowiki></code> che at abìlita a listé le sot-pagine',
	'spl-nosubpages' => "La pàgina $1 a l'ha gnun-e sot-pàgine da listé.",
	'spl-noparentpage' => 'La pàgina "$1" a esist pa.',
	'spl-nopages' => "Lë spassi nominal «$1» a l'ha gnun-e pàgine.",
	'spl-subpages-par-sort' => 'La diression për ordiné. Valor përmëttù: «asc» e «desc».',
	'spl-subpages-par-sortby' => 'Criteri për ordiné le pagine. Valor përmëttù :«tìtol» o «ùltima modìfica».',
	'spl-subpages-par-format' => "La lista dle sot-pàgine a peul esse mostrà an vàire formà. Valor përmëttù: «ol» - lista ordinà (numerà), «ul» lista nen ordinà (a pont), «lista» - lista sempia (për esempi, lista separà da 'd vìrgole).",
	'spl-subpages-par-page' => 'La pàgina dont smon-e le sot-pàgine. o lë spassi nominal. Për stàndard la pagina corenta.',
	'spl-subpages-par-showpage' => 'A ìndica se la pagina midema a dev esse mostrà ant la lista o nò.',
	'spl-subpages-par-pathstyle' => "Lë stit dël përcors për le sot-pàgine ant la lista. Valor përmëttù: «nòmcompletpàgina» - nòm complet ëd la pàgina (spassi nominal comprèis), «nòmpàgina» - nàm ëd la pàgina (sensa spassi nominal), «nòmsotpàgina» nòm relativ ëd la pàgina an ancaminand da la pàgina dont i smonoma le sot-pàgine, «gnun» - mach la part dël nòm apress l'ùltima bara.",
	'spl-subpages-par-kidsonly' => 'A përmëtt ëd mostré mach le sot-pàgine direte.',
	'spl-subpages-par-limit' => 'Ël nùmer màssim ëd pàgine da listé.',
	'spl-subpages-par-element' => 'L\'element HTML ch\'a comprend la lista (test comprendent "intro" e "outro" o "default"). Valor përmëttù: "div", "p", "span".',
	'spl-subpages-par-class' => "Ël valor për l'atribù «class» ëd l'element HTML ch'a anquadra la lista.",
	'spl-subpages-par-intro' => "Ël test da stampé prima dla lista, se la lista a l'é pa veuida.",
	'spl-subpages-par-outro' => "Ël test da stampé apress dla lista, se la lista a l'é pa veuida.",
	'spl-subpages-par-default' => "Ël test da stampé an leu dla lista, se la lista a l'é veuida. Se veuida, un mëssagi d'eror a sarà stampà (coma «La pàgina a l'ha gnun-e sot-pàgine da listé»). Se a-i é tratin («-»), l'arzultà a sarà completament veuid.",
	'spl-subpages-par-separator' => "Ël test da stampé tra doi element dla lista an cas ëd formà «list» (e sò alias «bar»). A l'ha pa d'efet ant j'àutri formà.",
	'spl-subpages-par-template' => "Ël nòm dlë stamp. Lë stamp a l'é aplicà a minca element dla lista. N'element a l'é passà com prim argoment (sensa nòm). Ch'a nòta che lë stamp a scancela pa ël formà dla lista. Ël formà («ul», «ol», «list») a l'é aplicà a l'arzultà dlë stamp.",
	'spl-subpages-par-links' => "S'a l'é ver, j'element dla lista a son stampà com dle liure. S'a l'é fàuss, j'element dla lista a son stampà com test normal. L'ùltim a l'é dzortut ùtil për passé dj'element ant jë stamp për n'àutr tratament.",
);

/** Portuguese (português)
 * @author Hamilton Abreu
 * @author Luckas
 */
$messages['pt'] = array(
	'spl-desc' => 'Acrescenta um elemento <code><nowiki><splist /></nowiki></code> que permite listar subpáginas',
	'spl-nosubpages' => 'A página $1 não tem subpáginas para listar.',
	'spl-noparentpage' => 'A página "$1" não existe.',
	'spl-nopages' => 'O espaço nominal "$1" não tem páginas.',
	'spl-subpages-par-sort' => 'A direção da ordenação. Valores permitidos: "asc" e "desc".',
	'spl-subpages-par-sortby' => 'O critério de ordenação. Valores permitidos: "title" (titulo) ou "lastedit" (última edição).',
	'spl-subpages-par-format' => 'A lista de subpáginas pode ser apresentada em vários formatos. Valores permitidos: "ol"— listas ordenadas (numeradas), "ul" — listas não ordenadas (com marcadores) e "list" — listas simples (por exemplo, lista separada por vírgulas).',
	'spl-subpages-par-page' => 'A página cujas subpáginas serão mostradas, ou o nome do espaço nominal (incluindo o sinal de dois pontos) do qual mostrar as páginas. Por omissão, será a página corrente.',
	'spl-subpages-par-showpage' => 'Indica se a própria página deve ser mostrada na lista ou não.',
	'spl-subpages-par-pathstyle' => 'O estilo do caminho para as subpáginas na lista. Valores permitidos: "fullpagename" — nome completo da página (incluindo o espaço nominal), "pagename" — nome da página (sem o espaço nominal), "subpagename" — nome relativo da página, começando a partir da página cujas subpáginas vão ser mostradas e "none" — somente a parte do nome após a última barra "/".',
	'spl-subpages-par-kidsonly' => 'Permite mostrar só subpáginas diretas.',
	'spl-subpages-par-limit' => 'O número máximo de páginas listadas.',
	'spl-subpages-par-element' => 'O elemento HTML que encapsula a lista (incluindo os textos "intro" e "outro" ou "default"). Valores permitidos: "div", "p" e "span".',
	'spl-subpages-par-class' => 'O valor do atributo "class" do elemento HTML que encapsula a lista.',
	'spl-subpages-par-intro' => 'O texto a apresentar antes da lista, se a lista não estiver vazia.',
	'spl-subpages-par-outro' => 'O texto a apresentar após a lista, se a lista não estiver vazia.',
	'spl-subpages-par-default' => 'O texto a apresentar em vez da lista, se a lista não estiver vazia. Se vazio, será apresentada uma mensagem de erro (como "A página não tem nenhuma subpágina para listar"). Se o valor for ("-"), o resultado estará completamente vazio.',
	'spl-subpages-par-separator' => 'O texto a apresentar entre duas entradas da lista no caso dos formatos "list" ou "bar". Não tem efeito nos outros formatos.',
	'spl-subpages-par-template' => 'O nome da predefinição. A predefinição é aplicada a cada entrada da lista. Uma entrada é passada como o primeiro argumento (anónimo). Note que a predefinição não cancela a formatação da lista. A formatação ("ul", "ol", ou "list") é aplicada ao resultado da predefinição.',
	'spl-subpages-par-links' => 'Se verdadeiro, as entradas da lista são apresentadas na forma de links. Se falso, as entradas da lista são apresentadas como texto simples. Esta última opção é especialmente útil para passar entradas a uma predefinição, para processamento posterior.',
);

/** tarandíne (tarandíne)
 * @author Joetaras
 */
$messages['roa-tara'] = array(
	'spl-nosubpages' => '\'A pàgene "$1" non ge tène sottopàggene da elengà.',
	'spl-noparentpage' => '\'A pàgene "$1" non g\'esiste.',
	'spl-nopages' => '\'U namespace "$1" non ge tène pàggene.',
	'spl-subpages-par-limit' => "'U massime numere de pàggene da elengà.",
);

/** Russian (русский)
 * @author Okras
 * @author Renessaince
 * @author Van de Bugger
 * @author Александр Сигачёв
 */
$messages['ru'] = array(
	'spl-desc' => 'Позволяет вывести список и количество подстраниц',
	'spl-nosubpages' => 'Страница «$1» не имеет подстраниц.',
	'spl-noparentpage' => 'Страница «$1» не существует.',
	'spl-nopages' => 'Пространство имён  «$1» не содержит страниц.',
	'spl-subpages-par-sort' => 'Направление сортировки. Допустимые значения: «asc» — сортировка по возрастанию, «desc» — по убыванию.',
	'spl-subpages-par-sortby' => 'Ключ сортировки подстраниц: «title» — сортировать по названию страниц, «lastedit» — по дате последней правки.',
	'spl-subpages-par-format' => 'Список подстраниц может быть показан в нескольких форматах. Допустимые значения: «ol» — нумерованный список, «ul» — маркированный список, «list» — линейный список (например, через запятые).',
	'spl-subpages-par-page' => 'Страница для которой показывать список подстраниц, или имя пространства имён (включая конечное двоеточие). По умолчанию — текущая страница.',
	'spl-subpages-par-showpage' => 'Указывает, должна ли отображаться сама страница.',
	'spl-subpages-par-pathstyle' => 'Стиль пути для подстраниц в списке. Допустимые значения: «fullpagename» — полное название страницы (включая пространство имён), «pagename» — имя страницы (полное, но без пространства имён), «subpagename» — относительное имя страницы, начиная со страницы, для которой показывается список, «none» — только часть имени, следующая за последней косой чертой.',
	'spl-subpages-par-kidsonly' => 'Показывать только прямые подстраницы.',
	'spl-subpages-par-limit' => 'Максимальное количество страниц в список.',
	'spl-subpages-par-element' => 'Элемент HTML, включающий весь список (вместе с текстами «intro» и «outro» или «default»). Допустимые значения: «div», «p», «span».',
	'spl-subpages-par-class' => 'Значение атрибута «class» элемента HTML.',
	'spl-subpages-par-intro' => 'Текст для вывод перед списком, если список не пуст.',
	'spl-subpages-par-outro' => 'Текст для вывода после списка, если список не пуст.',
	'spl-subpages-par-default' => 'Текст для вывода вместо списка, если список пуст.',
	'spl-subpages-par-separator' => 'Текст для вывода между двумя элементами списка для форматов "list" или "bar". Не имеет значения для других форматов.',
	'spl-subpages-par-template' => 'Имя шаблона. Шаблон применяется к каждому элементу списка. Элемент передаётся в шаблон как первый (неименованный) аргумент. Заметьте, что шаблон не отменяет форматирование списка. Форматирование ("ul", "ol", "list") применяется к результатам шаблона.',
	'spl-subpages-par-links' => 'Если истина, элементы списка выводятся как ссылки. Если ложь, элементы списка выводятся как простой текст, это особенно удобно, если применяется совместно с шаблоном.',
);

/** Sinhala (සිංහල)
 * @author පසිඳු කාවින්ද
 */
$messages['si'] = array(
	'spl-desc' => 'උපපිටු ලැයිස්තුගත කිරීමට සක්‍රිය වන <code><nowiki><splist /></nowiki></code> ටැගය එක් කරයි',
	'spl-nosubpages' => '"$1" සතුව ලැයිස්තුගත කිරීමට උපපිටු නැත.',
	'spl-noparentpage' => '"$1" පිටුව නොපවතී.',
	'spl-nopages' => '"$1" නාමඅවකාශය සතුව පිටු නොමැත.',
	'spl-subpages-par-limit' => 'ලැයිස්තුගත කල යුතු උපරිම පිටු ගණන.',
	'spl-subpages-par-intro' => 'ලැයිස්තුව හිස් නොවේ නම්, ලැයිස්තුවට පෙර ප්‍රතිදානය කල යුතු පෙළ.',
	'spl-subpages-par-outro' => 'ලැයිස්තුව හිස් නොවේ නම්, ලැයිස්තුවෙන් පසු ප්‍රතිදානය කල යුතු පෙළ.',
);

/** Serbian (Cyrillic script) (српски (ћирилица)‎)
 * @author Rancher
 */
$messages['sr-ec'] = array(
	'spl-subpages-par-limit' => 'Највећи број страница за приказивање.',
);

/** Serbian (Latin script) (srpski (latinica)‎)
 */
$messages['sr-el'] = array(
	'spl-subpages-par-limit' => 'Najveći broj stranica za prikazivanje.',
);

/** Swedish (svenska)
 * @author Jopparn
 */
$messages['sv'] = array(
	'spl-nosubpages' => 'Sidan " $1 " saknar undersidor att lista.',
	'spl-noparentpage' => 'Sidan "$1" finns inte.',
	'spl-nopages' => 'Namnrymden "$1" har inga sidor.',
	'spl-subpages-par-limit' => 'Det maximala antalet sidor att lista.',
);

/** Telugu (తెలుగు)
 * @author Veeven
 */
$messages['te'] = array(
	'spl-noparentpage' => '"$1" పేజీ లేనే లేదు.',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 */
$messages['tl'] = array(
	'spl-desc' => 'Nagdaragdag ng isang tatak na <code><nowiki><splist /></nowiki></code> na nagbibigay ng kakayahan sa iyo na magtala ng kabahaging mga pahina',
	'spl-nosubpages' => 'Walang maitatala na kabahaging mga pahina ang pahinang "$1".',
	'spl-noparentpage' => 'Hindi umiiral ang pahinang "$1".',
	'spl-nopages' => 'Walang mga pahina ang puwang ng pangalan na "$1".',
	'spl-subpages-par-sort' => 'Ang patutunguhan kung saan gagawa ng paghihiwa-hiwalay. Pinapayagang mga halaga: "pataas" at "pababa".',
	'spl-subpages-par-sortby' => 'Kung ano ang pagbabatayan ng paghihiwa-hiwalay ng kabahaging mga pahina. Pinapayagang mga halaga: "pamagat" o "huling pagbabago".',
	'spl-subpages-par-format' => 'Ang talaan ng kabahaging pahina ay maaaring ipakita sa ilang mga kaanyuhan. Pinpayagang mga halaga: "ol" — ordered (numbered) list o listahang magkakasunud-sunod (mayroong bilang) o, "ul" — unordered (bulleted) list o listahang walang pagkakasunud-sunod (napungluan), "list" — payak na listahan lamang (halimbawa na ang listahan na pinaghihiwalay-hiwalay ng kuwit).',
	'spl-subpages-par-page' => 'Ang pahinang pagpapakitaan ng kabahaging mga pahina, pangalan ng puwang na pampangalan (kabilang na ang trailing colon o bumabakas na tutuldok) na pagpapakitaan ng mga pahina. Likas na nakatakdang pumupunta sa pangkasalukuyang pahina.',
	'spl-subpages-par-showpage' => 'Nagpapahiwatig kung ang pahina mismo ay dapat na ipakita sa loob ng talaan o hindi.',
	'spl-subpages-par-pathstyle' => 'Ang estilo ng landas para sa kabahaging mga pahina na nasa loob ng talaan. Pinapayagang mga halaga: "fullpagename" — buong pangalan ng pahina (kabilang na ang puwang na pampangalan), "pagename" — pangalan ng pahina (walang puwang na pampangalan), "subpagename" — kaukol na pangalan ng pahina na nagsisimula mula sa pahina na pinaglilistahan namin ng kabahaging mga pahina, "none" o wala — ang bumubuntot na bahagi ng pangalan pagkaraan ng huling bantas na laslas.',
	'spl-subpages-par-kidsonly' => 'Nagpapahintulot na magpakita lamang ng tuwirang kabahaging mga pahina.',
	'spl-subpages-par-limit' => 'Ang pinakamataas na bilang ng mga pahinang itatala.',
	'spl-subpages-par-element' => 'Ang elemento ng HTML na nagkukulong sa listahan (kasama ang mga tekstong "intro" at "outro" o "default"). Pinapayagang mga halaga: "div", "p", "span".',
	'spl-subpages-par-class' => 'Ang halaga para sa katutubong katangian na "class" ng elemento ng HTML na kumukulong sa listahan.',
	'spl-subpages-par-intro' => 'Ang tekstong ilalabas bago ang listahan, kung mayroong laman ang talaan.',
	'spl-subpages-par-outro' => 'Ang tekstong ilalabas pagkaraan ng listahan, kung mayroong laman ang talaan.',
	'spl-subpages-par-default' => 'Ang ilalabas na teksto sa halip na ang listahan, kung mayroong laman ang talaan. Kapag walang laman, ihaharap ang mensahe ng kamalian (katulad ng "Ang pahina ay walang maililistang kabahaging mga pahina"). Kung gatla ("-"), ang resulta ay talagang walang laman.',
	'spl-subpages-par-separator' => 'Ang tekstong ilalabas sa pagitan ng dalawang mga bagay na panglistahan sa pagkakaton ng kaanyuang "list" (at ang bansag nitong "bar"). Walang epekto sa ibang mga kaanyuan.',
	'spl-subpages-par-template' => 'Ang pangalan ng suleras. Ang suleras ay inilalapat sa bawat isang bagay ng listahan. Ang bagay ay ipinapasa bilang ang unang (hindi napapangalanang) pangangatwiran. Unawain na ang suleras ay hindi nagpapawalang-bisa sa kaanyuan ng listahan. Ang pagkakaanyo o formatting ("ul", "ol", "list") ay inilalapat sa resulta ng suleras.',
	'spl-subpages-par-links' => 'Kung totoo, ang mga bagay na panglistahan ay inihaharap bilang mga kawing. Kapag hindi totoo, ang mga bagay na panglistahan ay inihaharap bilang mga teksto lamang talaga. Ang panghuli ay sadyang nakakatulong sa pagpapasa ng mga bagay papasok sa mga suleras para sa karagdagan pang pagpuproseso.',
);

/** Ukrainian (українська)
 * @author Andriykopanytsia
 * @author Base
 * @author Renessaince
 * @author Ата
 * @author Тест
 */
$messages['uk'] = array(
	'spl-desc' => 'Дозволяє заносити у список та рахувати підсторінки',
	'spl-nosubpages' => 'Сторінка "$1" не має підсторінок для складання списку.',
	'spl-noparentpage' => 'Сторінка «$1» не існує.',
	'spl-nopages' => 'У просторі назв «$1» немає сторінок.',
	'spl-subpages-par-sort' => 'Напрямок сортування. Допущальни значення: "asc" і "desc".',
	'spl-subpages-par-sortby' => 'Те, за чим сортуються підсторінки. Дозволені значення: "title" (за назвами) або "lastedit" (за датою останнього редагування).',
	'spl-subpages-par-format' => 'Список підсторінок може відображатись у кількох форматах. Дозволені значення: "ol" — нумерований список, "ul" — маркований список, "list" — лінійний список (наприклад, через кому).',
	'spl-subpages-par-page' => 'Сторінка, для якої показати підсторінки, або простір назв (разом з двокрапкою в кінці), для якого відобразити сторінки. За замовчуванням — поточна сторінка.',
	'spl-subpages-par-showpage' => 'Вказує, чи повинна відображатись у списку сама сторінка.',
	'spl-subpages-par-pathstyle' => 'Стиль шляху для підсторінок у списку. Дозволені значення: "fullpagename" — повна назва сторінки (разом з простором назв), "pagename" — назва сторінки (без простору назв), "subpagename" — відносна назва сторінки, що починається зі сторінки, для якої показується список, "none" — тільки частина назви після похилої риски.',
	'spl-subpages-par-kidsonly' => 'Дозволяє відобразити лише прямі підсторінки.',
	'spl-subpages-par-limit' => 'Максимальна кількість сторінок у списку.',
	'spl-subpages-par-element' => 'Елемент HTML, що включає список (разом з текстами "intro" і "outro" чи "default"). Дозволені значення: "div", "p", "span".',
	'spl-subpages-par-class' => 'Значення атрибуту "class" елементу HTML, що включає список.',
	'spl-subpages-par-intro' => 'Текст для відображення перед списком, якщо список не порожній.',
	'spl-subpages-par-outro' => 'Текст для відображення після списку, якщо список не порожній.',
	'spl-subpages-par-default' => 'Текст для відображення замість списку, якщо список порожній. Якщо порожній, то повідомлення про помилку буде виведено повідомлення про помилку (як-то "У сторінки немає підсторінок"). Якщо тире ("-"), результат буде повністю пустим.',
	'spl-subpages-par-separator' => 'Текст для відображення між двома елементами списку для формату "list" (і його замінника "bar"). Не впливає на інші формати.',
	'spl-subpages-par-template' => 'Назва шаблону. Шаблону застосовується до кожного елемента списку. Елемент передається в шаблон як перший (неіменований) аргумент. Зверніть увагу, що шаблон не скасовує форматування списку. Форматування ("ul", "ol", "list") застосовується до результатів шаблону.',
	'spl-subpages-par-links' => 'Якщо істина, елементи списку виводяться як посилання. Якщо хиба, елементи списку виводяться простим текстом, це особливо зручно для передачі елементів у шаблони для наступної обробки.',
);

/** Simplified Chinese (中文（简体）‎)
 * @author Yfdyh000
 */
$messages['zh-hans'] = array(
	'spl-desc' => '添加 <code><nowiki><splist /></nowiki></code> 标签，让您能列出子页面',
	'spl-nosubpages' => '页面“$1”没有子页面可列出。',
	'spl-noparentpage' => '页面“$1”不存在。',
	'spl-nopages' => '命名空间“$1”没有页面。',
	'spl-subpages-par-sort' => '要排序的方向。允许的值：“asc”和“desc”。',
	'spl-subpages-par-sortby' => '要按什么排序子页面。允许的值：“title”或“lastedit”。',
	'spl-subpages-par-kidsonly' => '允许显示仅直接的子页面。',
	'spl-subpages-par-limit' => '列出页面的最大数量。',
);

/** Traditional Chinese (中文（繁體）‎)
 * @author Shirayuki
 */
$messages['zh-hant'] = array(
	'spl-noparentpage' => '頁面"$1"不存在。',
);
