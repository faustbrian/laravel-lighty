import linkifyUrls from 'linkify-urls';
import shiki from 'shiki';
import { createRequire } from 'node:module';
import path from 'node:path';
import url from 'node:url';

const require = createRequire(import.meta.url);
const __dirname = url.fileURLToPath(new URL('.', import.meta.url));

const FontStyle = {
	NotSet: -1,
	None: 0,
	Italic: 1,
	Bold: 2,
	Underline: 4,
};

const FONT_STYLE_TO_CSS = {
	[FontStyle.Italic]: 'font-style: italic',
	[FontStyle.Bold]: 'font-weight: bold',
	[FontStyle.Underline]: 'text-decoration: underline',
};

const customLanguages = [
	{
		id: 'antlers',
		scopeName: 'text.html.statamic',
		path: getLanguagePath('antlers'),
		embeddedLangs: ['html'],
	},
];

const htmlEscapes = {
	'&': '&amp;',
	'<': '&lt;',
	'>': '&gt;',
	'"': '&quot;',
	'\'': '&#39;',
};

function escapeHtml(html) {
	return html.replace(/[&<>"']/g, (chr) => htmlEscapes[chr]);
}

function getLanguagePath(language) {
	const pathToShikiDistDirectory = path.dirname(require.resolve('shiki'));
	const pathToShikiLanguages = path.resolve(`${pathToShikiDistDirectory}/../languages`);
	const relativeDirectory = path.relative(pathToShikiLanguages, `${__dirname}/../languages`);

	return `${relativeDirectory}/${language}.tmLanguage.json`;
}

function Renderer(options) {
	function hasModifier(lineNumber, key) {
		if (options.lines[lineNumber] === undefined) {
			return false;
		}

		return options.lines[lineNumber].modifiers[key] !== undefined;
	}

	function anyHasModifier(key) {
		return Object.keys(options.lines).some((l) => hasModifier(l, key));
	}

	return {
		renderToHtml(lines) {
			const bg = options.bg || '#fff';

			let className = '';

			if (anyHasModifier('highlight')) {
				className += ' has-highlighted-lines';
			}

			if (anyHasModifier('add')) {
				className += ' has-added-lines';
			}

			if (anyHasModifier('delete')) {
				className += ' has-deleted-lines';
			}

			if (anyHasModifier('focus')) {
				className += ' has-focus-lines';
			}

			let html = '';

			html += `<pre class="lighty">`;
			if (options.langId) {
				html += `<div class="language-id">${options.langId}</div>`;
			}
			html += `<code class="${className}" style="background-color: ${bg}">`;

			lines.forEach((l, index) => {
				let lineNumber = index + 1;

				let lineClass = 'line';
				if (hasModifier(lineNumber, 'highlight')) {
					lineClass += ' line-highlight';
				}

				if (hasModifier(lineNumber, 'add')) {
					lineClass += ' line-add';
				}

				if (hasModifier(lineNumber, 'delete')) {
					lineClass += ' line-delete';
				}

				if (hasModifier(lineNumber, 'focus')) {
					lineClass += ' line-focus';
				}

				if (hasModifier(lineNumber, 'class')) {
					for (const classLine of options.lines[lineNumber].modifiers.class) {
						lineClass += ` ${classLine}`;
					}
				}

				const isSummaryOpen = hasModifier(lineNumber, 'collapse') && !hasModifier(lineNumber - 1, 'collapse');
				const isSummaryMiddle = hasModifier(lineNumber - 1, 'collapse') &&
					hasModifier(lineNumber, 'collapse') && hasModifier(lineNumber + 1, 'collapse');
				const isSummaryClose = hasModifier(lineNumber, 'collapse') && !hasModifier(lineNumber + 1, 'collapse');

				if (isSummaryOpen) {
					html += `<details>`;
					html += `<summary style="cursor: pointer; display: block">`;
				}

				if (hasModifier(lineNumber, 'id')) {
					let id = '';
					for (const idLine of options.lines[lineNumber].modifiers.id) {
						id += ` ${idLine}`;
					}

					html += `<div class="${lineClass.trim()}" id="${id.trim()}">`;
				} else {
					html += `<div class="${lineClass.trim()}">`;
				}

				if (options.showLineNumbers === true) {
					if (hasModifier(lineNumber, 'add')) {
						html +=
							`<span style="color:#C3E88D; text-align: right; user-select: none;" class="line-number"> ${
								options.showDiffIndicatorsInPlaceOfLineNumbers
									? '+'
									: options.lines[lineNumber].modifiedNumber
							}</span>`;
					} else if (hasModifier(lineNumber, 'delete')) {
						html +=
							`<span style="color:#f07178; text-align: right; -webkit-user-select: none; user-select: none;" class="line-number"> ${
								options.showDiffIndicatorsInPlaceOfLineNumbers
									? '-'
									: options.lines[lineNumber].modifiedNumber
							}</span>`;
					} else if (options.lines[lineNumber].modifiedNumber === 0) {
						html +=
							`<span style="color:#3A3F58; text-align: right; user-select: none;" class="line-number"></span>`;
					} else {
						html +=
							`<span style="color:#3A3F58; text-align: right; user-select: none;" class="line-number"> ${
								options.lines[lineNumber].modifiedNumber
							}</span>`;
					}
				}

				if (anyHasModifier('add') || anyHasModifier('delete')) {
					// Only show diff indicators if line numbers are disabled
					if (
						options.showLineNumbers === false &&
						options.showDiffIndicators === true &&
						options.showDiffIndicatorsInPlaceOfLineNumbers === true
					) {
						if (hasModifier(lineNumber, 'add')) {
							html +=
								`<span style="color:#C3E88D; text-align: right; user-select: none;" class="line-number"> +</span>`;
						} else if (hasModifier(lineNumber, 'delete')) {
							html +=
								`<span style="color:#f07178; text-align: right; user-select: none;" class="line-number"> -</span>`;
						} else {
							html +=
								`<span class="line-number" style="text-align: right; user-select: none; color: #3A3F58"></span>`;
						}
					}

					// Show diff indicators next to line numbers
					if (
						options.showLineNumbers === true &&
						options.showDiffIndicators === true &&
						options.showDiffIndicatorsInPlaceOfLineNumbers === false
					) {
						if (hasModifier(lineNumber, 'add')) {
							html +=
								`<span style="color:#C3E88D; text-align: left; user-select: none;" class="diff-indicator diff-indicator-add"> +</span>`;
						} else if (hasModifier(lineNumber, 'delete')) {
							html +=
								`<span style="color:#f07178; text-align: left; user-select: none;" class="diff-indicator diff-indicator-delete"> -</span>`;
						} else {
							html +=
								`<span class="diff-indicator diff-indicator-empty" style="text-align: left; user-select: none; color: #3A3F58"></span>`;
						}
					}
				}

				if (anyHasModifier('collapse')) {
					if (isSummaryOpen) {
						html +=
							`<span class="summary-caret summary-caret-start" style="user-select: none; color: #3A3F58"></span>`;
					}

					if (isSummaryMiddle) {
						html +=
							`<span class="summary-caret summary-caret-middle" style="user-select: none; color: #3A3F58"></span>`;
					}

					if (isSummaryClose) {
						html +=
							`<span class="summary-caret summary-caret-end" style="user-select: none; color: #3A3F58"></span>`;
					}

					if (!hasModifier(lineNumber, 'collapse')) {
						html +=
							`<span class="summary-caret summary-caret-empty" style="user-select: none; color: #3A3F58"></span>`;
					}
				}

				l.forEach((token) => {
					const cssDeclarations = [`color: ${token.color || options.fg}`];

					if (token.fontStyle > FontStyle.None) {
						cssDeclarations.push(FONT_STYLE_TO_CSS[token.fontStyle]);
					}

					if (hasModifier(lineNumber, 'add')) {
						cssDeclarations.push(`color: #C3E88D`);
					}

					if (hasModifier(lineNumber, 'delete')) {
						cssDeclarations.push(`color: #f07178`);
					}

					let content = escapeHtml(token.content);
					if (hasModifier(lineNumber, 'autolink')) {
						content = linkifyUrls(content, {
							attributes: {
								rel: 'noopener noreferrer',
								style: 'color: inherit;',
								target: '_blank',
							},
						});
					}

					html += `<span style="${cssDeclarations.join('; ')}">${content}</span>`;
				});

				if (isSummaryOpen) {
					html += `<span class="summary-hide-when-open" style="color:#3A3F58">...</span>`;
					html += `</div>\n`;
					html += `</summary>\n`;
				} else {
					html += `</div>\n`;
				}

				if (isSummaryClose) {
					html += `</details>`;
				}
			});
			html = html.replace(/\n*$/, '');
			html += `</code></pre>`;

			return html;
		},
	};
}

function render(highlighter, args, language) {
	const tokens = highlighter.codeToThemedTokens(args[0], language);
	const theme = highlighter.getTheme();
	const options = args[3] || {};
	const renderer = Renderer({
		fg: theme.fg,
		bg: theme.bg,
		lines: options.lines,
		showLineNumbers: options.showLineNumbers,
		showDiffIndicators: options.showDiffIndicators,
		showDiffIndicatorsInPlaceOfLineNumbers: options.showDiffIndicatorsInPlaceOfLineNumbers,
	});

	process.stdout.write(renderer.renderToHtml(tokens));
}

async function main() {
	const args = JSON.parse(process.argv.slice(2));

	let allLanguages = shiki.BUNDLED_LANGUAGES;
	allLanguages.push(...customLanguages);

	const language = args[1];
	let theme = args[2];

	const languagesToLoad = allLanguages.filter((lang) =>
		lang.id === language || (lang.aliases && lang.aliases.includes(language))
	);

	(function loadEmbeddedLangsRecursively() {
		languagesToLoad.forEach(function (language) {
			const embeddedLangs = language.embeddedLangs || [];
			embeddedLangs.forEach(function (languageKey) {
				if (
					languagesToLoad.find((lang) =>
						lang.id === languageKey || (lang.aliases && lang.aliases.includes(languageKey))
					)
				) {
					return;
				}

				languagesToLoad.push(
					allLanguages.find((lang) =>
						lang.id === languageKey || (lang.aliases && lang.aliases.includes(languageKey))
					),
				);

				loadEmbeddedLangsRecursively();
			});
		});
	})();

	if (typeof theme === 'string') {
		try {
			theme = JSON.parse(theme);
		} catch {
			//
		}
	}

	const highlighter = await shiki.getHighlighter({
		theme,
		langs: languagesToLoad,
	});

	if (typeof language === 'string') {
		try {
			await highlighter.loadLanguage(JSON.parse(language));
		} catch {
			//
		}
	}

	render(highlighter, args, language);
}

main();
