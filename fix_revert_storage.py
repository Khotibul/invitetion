#!/usr/bin/env python3
import glob, os

controllers = glob.glob('app/Http/Controllers/**/*.php', recursive=True)
controllers += glob.glob('app/Http/Controllers/*.php')

total = 0
for path in sorted(controllers):
    src = open(path, 'r', encoding='utf-8').read()
    original = src
    src = src.replace('Storage::disk(active_disk())', "Storage::disk('public')")
    if src != original:
        open(path, 'w', encoding='utf-8').write(src)
        n = original.count('Storage::disk(active_disk())')
        total += n
        print(f'  Reverted {n}x: {os.path.basename(path)}')

print(f'\nTotal reverted: {total}')
