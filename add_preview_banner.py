#!/usr/bin/env python3
import glob, os, re

TEMPLATES = glob.glob('resources/views/template/*.blade.php')
BANNER = "@include('template.partials.preview-banner')"
SKIP = ['default.blade.php']

updated = []
for path in sorted(TEMPLATES):
    fname = os.path.basename(path)
    if fname in SKIP:
        continue

    src = open(path, 'r', encoding='utf-8').read()

    if BANNER in src:
        print(f'  already has banner: {fname}')
        continue

    # Insert right after <body> tag
    if '<body>' in src:
        new_src = src.replace('<body>', '<body>\n' + BANNER, 1)
        open(path, 'w', encoding='utf-8').write(new_src)
        updated.append(fname)
        print(f'  UPDATED: {fname}')
    elif '<body ' in src:
        # body with attributes
        new_src = re.sub(r'(<body[^>]*>)', r'\1\n' + BANNER, src, count=1)
        open(path, 'w', encoding='utf-8').write(new_src)
        updated.append(fname)
        print(f'  UPDATED (body with attrs): {fname}')
    else:
        print(f'  SKIPPED (no body tag): {fname}')

print(f'\nTotal updated: {len(updated)}')
