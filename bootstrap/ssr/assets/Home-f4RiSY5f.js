import { ref, watch, onMounted, withCtx, unref, createVNode, useSSRContext } from "vue";
import { ssrRenderComponent } from "vue/server-renderer";
import { _ as _sfc_main$1 } from "./AuthenticatedLayout-C9N4_aJT.js";
import { Head } from "@inertiajs/vue3";
import { Line } from "vue-chartjs";
import { Chart, CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend } from "chart.js";
import "@heroicons/vue/24/solid";
const _sfc_main = {
  __name: "Home",
  __ssrInlineRender: true,
  setup(__props) {
    Chart.register(
      CategoryScale,
      LinearScale,
      PointElement,
      LineElement,
      Title,
      Tooltip,
      Legend
    );
    const currentTheme = ref(localStorage.getItem("theme") || "nord");
    const chartData = ref({
      labels: ["January", "February", "March", "April", "May", "June"],
      datasets: [
        {
          label: "Sample Data",
          backgroundColor: "rgba(147, 51, 234, 0.2)",
          // Solid purple with opacity
          borderColor: "#9333EA",
          // Solid purple
          borderWidth: 2,
          tension: 0.4,
          data: [40, 20, 12, 39, 10, 30]
        }
      ]
    });
    const chartOptions = ref({
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          labels: {
            color: "#1F2937"
            // Dark gray for text
          }
        }
      },
      scales: {
        x: {
          grid: {
            color: "rgba(31, 41, 55, 0.1)"
            // Dark gray with opacity for grid
          },
          ticks: {
            color: "#1F2937"
            // Dark gray for text
          }
        },
        y: {
          grid: {
            color: "rgba(31, 41, 55, 0.1)"
            // Dark gray with opacity for grid
          },
          ticks: {
            color: "#1F2937"
            // Dark gray for text
          }
        }
      }
    });
    watch(
      () => localStorage.getItem("theme"),
      (newTheme) => {
        if (newTheme !== currentTheme.value) {
          currentTheme.value = newTheme;
          chartData.value = { ...chartData.value };
        }
      }
    );
    onMounted(() => {
      chartData.value = { ...chartData.value };
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(ssrRenderComponent(_sfc_main$1, _attrs, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(unref(Head), { title: "Dashboard" }, null, _parent2, _scopeId));
            _push2(`<div class="mt-6 flex flex-col gap-4"${_scopeId}><div class="chart-container w-full justify-center"${_scopeId}>`);
            _push2(ssrRenderComponent(unref(Line), {
              data: chartData.value,
              options: chartOptions.value
            }, null, _parent2, _scopeId));
            _push2(`</div></div>`);
          } else {
            return [
              createVNode(unref(Head), { title: "Dashboard" }),
              createVNode("div", { class: "mt-6 flex flex-col gap-4" }, [
                createVNode("div", { class: "chart-container w-full justify-center" }, [
                  createVNode(unref(Line), {
                    data: chartData.value,
                    options: chartOptions.value
                  }, null, 8, ["data", "options"])
                ])
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Home.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
