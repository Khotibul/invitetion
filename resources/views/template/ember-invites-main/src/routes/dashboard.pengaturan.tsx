import { createFileRoute } from "@tanstack/react-router";
import { useInvitation } from "@/lib/invitation-store";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { Switch } from "@/components/ui/switch";
import {
  Select, SelectContent, SelectItem, SelectTrigger, SelectValue,
} from "@/components/ui/select";
import {
  AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent,
  AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle,
  AlertDialogTrigger,
} from "@/components/ui/alert-dialog";
import { toast } from "sonner";
import { Copy, Globe, RotateCcw } from "lucide-react";

export const Route = createFileRoute("/dashboard/pengaturan")({
  component: PengaturanPage,
});

function PengaturanPage() {
  const { data, update, reset } = useInvitation();

  const slug = (data.brideName.split(" ")[0] + "-" + data.groomName.split(" ")[0]).toLowerCase();
  const url = typeof window !== "undefined" ? `${window.location.origin}/?u=${slug}` : `/?u=${slug}`;

  const copyLink = async () => {
    await navigator.clipboard.writeText(url);
    toast.success("Tautan disalin");
  };

  return (
    <div className="space-y-6">
      <div>
        <p className="text-xs uppercase tracking-[0.3em] text-gold">Konfigurasi</p>
        <h1 className="font-display text-3xl md:text-4xl mt-1">Pengaturan Undangan</h1>
      </div>

      <Card className="border-gold/30">
        <CardHeader><CardTitle className="font-display text-2xl">Jenis Acara & Tema</CardTitle></CardHeader>
        <CardContent className="grid md:grid-cols-2 gap-4">
          <div className="grid gap-2">
            <Label>Jenis Acara</Label>
            <Select value={data.eventType} onValueChange={(v) => update({ eventType: v })}>
              <SelectTrigger><SelectValue /></SelectTrigger>
              <SelectContent>
                <SelectItem value="Pernikahan">Pernikahan</SelectItem>
                <SelectItem value="Khitanan">Khitanan</SelectItem>
                <SelectItem value="Aqiqah">Aqiqah</SelectItem>
                <SelectItem value="Ulang Tahun">Ulang Tahun</SelectItem>
                <SelectItem value="Lainnya">Lainnya</SelectItem>
              </SelectContent>
            </Select>
          </div>
          <div className="grid gap-2">
            <Label>Tema Visual</Label>
            <Select value={data.theme} onValueChange={(v) => update({ theme: v as never })}>
              <SelectTrigger><SelectValue /></SelectTrigger>
              <SelectContent>
                <SelectItem value="floral-gold">Floral & Gold</SelectItem>
                <SelectItem value="minimal">Minimalis</SelectItem>
                <SelectItem value="tropical">Tropical Bali</SelectItem>
                <SelectItem value="islamic">Islamic / Syar&apos;i</SelectItem>
              </SelectContent>
            </Select>
          </div>
        </CardContent>
      </Card>

      <Card className="border-gold/30">
        <CardHeader><CardTitle className="font-display text-2xl flex items-center gap-2"><Globe className="w-5 h-5 text-gold" />Publikasi</CardTitle></CardHeader>
        <CardContent className="space-y-4">
          <div className="flex items-center justify-between rounded-lg border border-gold/30 bg-card/50 p-4">
            <div>
              <div className="font-medium">Status Publikasi</div>
              <div className="text-xs text-muted-foreground">
                Saat aktif, undangan dapat dibagikan ke tamu.
              </div>
            </div>
            <Switch checked={data.published} onCheckedChange={(v) => update({ published: v })} />
          </div>

          <div className="grid gap-2">
            <Label>Tautan Undangan</Label>
            <div className="flex gap-2">
              <Input readOnly value={url} />
              <Button onClick={copyLink} variant="outline" className="gap-2">
                <Copy className="w-4 h-4" />Salin
              </Button>
            </div>
          </div>
        </CardContent>
      </Card>

      <Card className="border-destructive/40">
        <CardHeader><CardTitle className="font-display text-2xl text-destructive">Zona Berbahaya</CardTitle></CardHeader>
        <CardContent>
          <AlertDialog>
            <AlertDialogTrigger asChild>
              <Button variant="destructive" className="gap-2"><RotateCcw className="w-4 h-4" />Reset Semua Data</Button>
            </AlertDialogTrigger>
            <AlertDialogContent>
              <AlertDialogHeader>
                <AlertDialogTitle>Reset semua data?</AlertDialogTitle>
                <AlertDialogDescription>
                  Tindakan ini akan mengembalikan semua konten ke nilai awal. Data RSVP juga akan hilang.
                </AlertDialogDescription>
              </AlertDialogHeader>
              <AlertDialogFooter>
                <AlertDialogCancel>Batal</AlertDialogCancel>
                <AlertDialogAction
                  onClick={() => {
                    reset();
                    toast.success("Data direset");
                  }}
                >
                  Ya, reset
                </AlertDialogAction>
              </AlertDialogFooter>
            </AlertDialogContent>
          </AlertDialog>
        </CardContent>
      </Card>
    </div>
  );
}
