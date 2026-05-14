import { createFileRoute } from "@tanstack/react-router";
import { useInvitation } from "@/lib/invitation-store";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { Button } from "@/components/ui/button";
import { toast } from "sonner";

export const Route = createFileRoute("/dashboard/mempelai")({
  component: MempelaiPage,
});

function MempelaiPage() {
  const { data, update } = useInvitation();

  const field = (k: keyof typeof data, label: string, multiline = false) => (
    <div className="grid gap-2">
      <Label>{label}</Label>
      {multiline ? (
        <Textarea
          rows={3}
          value={(data[k] as string) ?? ""}
          onChange={(e) => update({ [k]: e.target.value } as never)}
        />
      ) : (
        <Input
          value={(data[k] as string) ?? ""}
          onChange={(e) => update({ [k]: e.target.value } as never)}
        />
      )}
    </div>
  );

  return (
    <div className="space-y-6">
      <div>
        <p className="text-xs uppercase tracking-[0.3em] text-gold">Profil</p>
        <h1 className="font-display text-3xl md:text-4xl mt-1">Data Mempelai</h1>
      </div>

      <div className="grid md:grid-cols-2 gap-6">
        <Card className="border-gold/30">
          <CardHeader><CardTitle className="font-display text-2xl">Mempelai Wanita</CardTitle></CardHeader>
          <CardContent className="space-y-4">
            {field("brideName", "Nama Lengkap")}
            {field("brideFather", "Nama Ayah")}
            {field("brideMother", "Nama Ibu")}
          </CardContent>
        </Card>

        <Card className="border-gold/30">
          <CardHeader><CardTitle className="font-display text-2xl">Mempelai Pria</CardTitle></CardHeader>
          <CardContent className="space-y-4">
            {field("groomName", "Nama Lengkap")}
            {field("groomFather", "Nama Ayah")}
            {field("groomMother", "Nama Ibu")}
          </CardContent>
        </Card>
      </div>

      <Card className="border-gold/30">
        <CardHeader><CardTitle className="font-display text-2xl">Quote / Ayat</CardTitle></CardHeader>
        <CardContent className="space-y-4">
          {field("quote", "Kutipan pembuka", true)}
        </CardContent>
      </Card>

      <div className="flex justify-end">
        <Button onClick={() => toast.success("Tersimpan otomatis")}>Tersimpan</Button>
      </div>
    </div>
  );
}
