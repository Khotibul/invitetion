import { createFileRoute } from "@tanstack/react-router";
import { useInvitation, uid, type StoryItem } from "@/lib/invitation-store";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { Button } from "@/components/ui/button";
import { Plus, Trash2, ImagePlus } from "lucide-react";
import { useState } from "react";
import { toast } from "sonner";

export const Route = createFileRoute("/dashboard/galeri")({
  component: GaleriPage,
});

function GaleriPage() {
  const { data, update } = useInvitation();
  const [newUrl, setNewUrl] = useState("");
  const [newCaption, setNewCaption] = useState("");

  const addPhoto = () => {
    if (!newUrl.trim()) return toast.error("Masukkan URL foto");
    update({ gallery: [...data.gallery, { id: uid(), url: newUrl.trim(), caption: newCaption.trim() }] });
    setNewUrl("");
    setNewCaption("");
    toast.success("Foto ditambahkan");
  };

  const removePhoto = (id: string) => {
    update({ gallery: data.gallery.filter((g) => g.id !== id) });
  };

  const patchStory = (id: string, patch: Partial<StoryItem>) => {
    update({ story: data.story.map((s) => (s.id === id ? { ...s, ...patch } : s)) });
  };

  const addStory = () => {
    update({ story: [...data.story, { id: uid(), year: "", title: "", description: "" }] });
  };

  const removeStory = (id: string) => {
    update({ story: data.story.filter((s) => s.id !== id) });
  };

  return (
    <div className="space-y-6">
      <div>
        <p className="text-xs uppercase tracking-[0.3em] text-gold">Konten</p>
        <h1 className="font-display text-3xl md:text-4xl mt-1">Galeri & Love Story</h1>
      </div>

      <Card className="border-gold/30">
        <CardHeader><CardTitle className="font-display text-2xl flex items-center gap-2"><ImagePlus className="w-5 h-5 text-gold" />Tambah Foto</CardTitle></CardHeader>
        <CardContent className="grid md:grid-cols-[1fr_1fr_auto] gap-3 items-end">
          <div className="grid gap-2">
            <Label>URL Foto</Label>
            <Input placeholder="https://..." value={newUrl} onChange={(e) => setNewUrl(e.target.value)} />
          </div>
          <div className="grid gap-2">
            <Label>Caption (opsional)</Label>
            <Input value={newCaption} onChange={(e) => setNewCaption(e.target.value)} />
          </div>
          <Button onClick={addPhoto} className="gap-2"><Plus className="w-4 h-4" />Tambah</Button>
        </CardContent>
      </Card>

      <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        {data.gallery.map((g) => (
          <div key={g.id} className="group relative rounded-xl overflow-hidden border border-gold/30 shadow-card aspect-square bg-muted">
            <img src={g.url} alt={g.caption ?? ""} className="w-full h-full object-cover" />
            <button
              onClick={() => removePhoto(g.id)}
              className="absolute top-2 right-2 w-8 h-8 rounded-full bg-destructive text-destructive-foreground grid place-items-center opacity-0 group-hover:opacity-100 transition"
            >
              <Trash2 className="w-4 h-4" />
            </button>
            {g.caption && (
              <div className="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/70 to-transparent text-white text-xs p-2">
                {g.caption}
              </div>
            )}
          </div>
        ))}
        {data.gallery.length === 0 && (
          <div className="col-span-full text-center text-muted-foreground py-10 border border-dashed border-gold/30 rounded-xl">
            Belum ada foto. Tambahkan URL gambar di atas.
          </div>
        )}
      </div>

      <div className="flex items-end justify-between flex-wrap gap-3 pt-4">
        <h2 className="font-display text-2xl">Love Story</h2>
        <Button onClick={addStory} variant="outline" className="gap-2"><Plus className="w-4 h-4" />Tambah Cerita</Button>
      </div>

      <div className="grid gap-4">
        {data.story.map((s) => (
          <Card key={s.id} className="border-gold/30">
            <CardContent className="p-5 grid md:grid-cols-[120px_1fr_auto] gap-4 items-start">
              <Input value={s.year} onChange={(e) => patchStory(s.id, { year: e.target.value })} placeholder="Tahun" />
              <div className="grid gap-2">
                <Input value={s.title} onChange={(e) => patchStory(s.id, { title: e.target.value })} placeholder="Judul" />
                <Textarea rows={2} value={s.description} onChange={(e) => patchStory(s.id, { description: e.target.value })} placeholder="Deskripsi" />
              </div>
              <Button variant="ghost" size="icon" onClick={() => removeStory(s.id)}>
                <Trash2 className="w-4 h-4 text-destructive" />
              </Button>
            </CardContent>
          </Card>
        ))}
      </div>
    </div>
  );
}
